<?php 
namespace Services;

use Models\Users\User;

class EmailSenderLetters 
{
    public static function sendLetter(User $receive, string $subject, string $templateName, array $templateVars) : void 
    {
        extract($templateVars);
        
        ob_start();
        require __DIR__ . '/../Templates/Mail/' . $templateName; 
        $body = ob_get_contents();
        ob_end_clean();

        mail($receive->getEmail(), $subject, $body, 'Content-Type: text/html; charset=UTF-8');
    }
}