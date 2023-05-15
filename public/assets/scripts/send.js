var state = 'gpt';

// Получение элементов
const mygptBlock = document.querySelector('.mygpt-button');
const gptBlockButton = document.querySelector('.gpt-block-button');

// Функция для обновления стилей
function updateStyles() {
    if (document.cookie.includes('state=gabella')) {
        mygptBlock.style.border = '1px dotted #ea2121';
        gptBlockButton.style.border = 'none';
    } else if (document.cookie.includes('state=gpt')) {
        gptBlockButton.style.border = '1px dotted #00A67E';
        mygptBlock.style.border = 'none';
    }
}

// Изменение значения переменной и обновление стилей
// Например, при клике на кнопку
const button1 = document.querySelector('#button1');
const button2 = document.querySelector('#button2');

function gabella()  {
    state = 'gabella'
    document.cookie = "state=" + state + "; expires=" + new Date(Date.now() + 86400000).toUTCString() + "; path=/";
    updateStyles();
}

function gpt() {
    state = 'gpt'
    document.cookie = "state=" + state + "; expires=" + new Date(Date.now() + 86400000).toUTCString() + "; path=/"
    updateStyles();
}

function getCookieValue(name) {
    // Получение строки куки
    const cookieString = document.cookie;

    // Поиск индекса начала значения
    const startIndex = cookieString.indexOf(`${name}=`);

    // Если значение найдено, то извлечение значения
    if (startIndex !== -1) {
        // Поиск индекса конца значения
        const endIndex = cookieString.indexOf(';', startIndex + name.length + 1) || cookieString.length;
        // Извлечение значения из строки куки
        const value = decodeURIComponent(cookieString.substring(startIndex + name.length + 1, endIndex));
        return value;
    } else {
        return null;
    }
}

const stateValue = getCookieValue('state');
if (stateValue === null) {
    state = 'gpt';
    document.cookie = "state=" + state + "; expires=" + new Date(Date.now() + 86400000).toUTCString() + "; path=/"

}
// Вызов функции для обновления стилей при загрузке страницы
updateStyles();