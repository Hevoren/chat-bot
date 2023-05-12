<?php
    class TemplateRenderer {

        public function renderTemplate(string $template, array $params = []): bool|string
        {
            extract($params);
            ob_start();
            include $template;
            return ob_get_clean();
        }

    }