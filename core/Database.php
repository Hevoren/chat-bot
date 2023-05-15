<?php

require_once __DIR__ . '/../core/Answers.php';
require_once __DIR__ . '/../core/Bot.php';

class Database
{
    private $link = null;

    public function __construct($host, $user, $password, $db)
    {
        $this->link = mysqli_connect($host, $user, $password, $db);
        if (mysqli_connect_errno()) {
            echo "Соединение не удалось: " . mysqli_connect_error();
            die();
        }
    }

    public function loginUser($login, $password)
    {
        $stmt = $this->link->prepare("SELECT * FROM users WHERE login=? LIMIT 1");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows !== 1) {
            return ['status' => 'error', 'errors' => ['Неправильный логин или пароль']];
        }
        $user = $result->fetch_assoc();
        $isPassword = password_verify($password, $user['password']);
        if (!$isPassword) {
            return ['status' => 'error', 'errors' => ['Неправильный логин или пароль']];
        }
        $userHash = hash('sha256', $user['user_id']);
        return ['status' => 'ok', 'user' => [
            'user_id' => $user['user_id'],
            'login' => $user['login'],
            'userHash' => $userHash
        ]
        ];
    }

    public function registerUser($name, $login, $password)
    {
        // Валидация логина
        if (empty($login)) {
            return ['status' => 'error', 'errors' => ['Логин не может быть пустым']];
        } else {
            $existingUser = $this->getUserByLogin($login);
            if ($existingUser) {
                return ['status' => 'error', 'errors' => ['Пользователь с таким логином уже существует']];
            }
        }

        // Валидация пароля
        if (empty($password)) {
            return ['status' => 'error', 'errors' => ['Пароль не может быть пустым']];
        } else {
            if (strlen($password) < 8) {
                return ['status' => 'error', 'errors' => ['Пароль должен быть не менее 8 символов']];
            }
            if (!preg_match('/[A-Z]/', $password)) {
                return ['status' => 'error', 'errors' => ['Пароль должен содержать хотя бы одну заглавную букву']];
            }
            if (!preg_match('/[a-z]/', $password)) {
                return ['status' => 'error', 'errors' => ['Пароль должен содержать хотя бы одну строчную букву']];
            }
            if (!preg_match('/\d/', $password)) {
                return ['status' => 'error', 'errors' => ['Пароль должен содержать хотя бы одну цифру']];
            }
        }

        if (isset($error)) {
            return ['status' => 'error', 'errors' => [$error]];
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users SET username='$name', login='$login', password='$passwordHash'";
        $result = mysqli_query($this->link, $query);

        if ($result) {
            $user = $this->getUserByLogin($login);
            return ['status' => 'success', 'user' => $user];
        } else {
            return ['status' => 'error', 'errors' => ['Ошибка регистрации пользователя']];
        }
    }

    public function sendMessage($user_id, $message, $state)
    {
        if (empty($message)) {
            return ['status' => 'error', 'errors' => ['Пусто']];
        }
        $query = "INSERT INTO messages SET user_id='$user_id', message='$message'";
        $result = mysqli_query($this->link, $query);

        $query = "SELECT message FROM messages WHERE user_id='$user_id' ORDER BY timestamp DESC LIMIT 1";
        $result = mysqli_query($this->link, $query);

        $messages = mysqli_fetch_assoc($result);

        foreach ($messages as $message) {
            $question = $message;
        }

        if($state === 'gpt') {
            $apiKey = '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';

            $bot = new Bot($apiKey);

            $answer = $bot->answerBot($question);
        }
        elseif ($state === 'gabella') {
            $botAnswers = new Answers();
            $answer = $botAnswers->answers($question);
        }
        $query = "INSERT INTO botmessages SET user_id='$user_id', botmessage='$answer'";
        $answer = mysqli_query($this->link, $query);

        if ($answer) {
            return ['status' => 'success', 'user' => $answer];
        } else {
            return ['status' => 'error', 'errors' => ['Ошибка отправки сообщения']];
        }

    }

    public function getMessages()
    {
        $user_id = $_SESSION['user_id'];
        $query = "SELECT message FROM messages WHERE user_id='$user_id'";
        $result = mysqli_query($this->link, $query);
        $messages = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $messages[] = $row;
            }
        }
        return $messages;
    }

    public function getBotMessages()
    {
        $user_id = $_SESSION['user_id'];
        $query = "SELECT botmessage FROM botmessages WHERE user_id='$user_id'";
        $result = mysqli_query($this->link, $query);
        $botmessages = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $botmessages[] = $row;
            }
        }
        return $botmessages;
    }

    public function getUserByLogin($login)
    {
        $query = "SELECT * FROM users WHERE login='$login'";
        $result = mysqli_query($this->link, $query);
        if ($result) {
            $user = mysqli_fetch_assoc($result);
            return $user;
        } else {
            return false;
        }
    }

    public function clearHistory($user_id)
    {
        $query = "DELETE FROM messages WHERE user_id='$user_id'";
        $result = mysqli_query($this->link, $query);
        $query = "DELETE FROM botmessages WHERE user_id='$user_id'";
        $result = mysqli_query($this->link, $query);

        if ($result) {
            return ['status' => 'success', 'user' => $result];
        } else {
            return ['status' => 'error', 'errors' => ['Ошибка удаления']];
        }
    }
}