<?php

/**
 * Description of mail
 *
 * @author jonas
 */
require_once 'phpmailer/class.phpmailer.php';

//dados vindos do formulario

$nome = $_POST['nome'] ? $_POST['nome'] : "";
$remetente = $_POST['remetente'] ? $_POST['remetente'] : "";
$destinatario = $_POST['destinatario'] ? $_POST['destinatario'] : "";
$assunto = $_POST['assunto'] ? $_POST['assunto'] : "";
$mensagem = $_POST['mensagem'] ? $_POST['mensagem'] : "";


//dados do servidor

$host = "";
$username = "";
$password = "";

// dados do remetente;

$from = $remetente;
$sender = $remetente;
$fromname = $nome;


// Inicia a classe PHPMailer
$mail = new PHPMailer();

// Define os dados do servidor e tipo de conexão

$mail->IsSMTP(); // Define que a mensagem será SMTP
//$mail->Host = "localhost"; // Endereço do servidor SMTP (caso queira utilizar a autenticação, utilize o host smtp.seudomínio.com.br)
$mail->SMTPAuth = true; // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
$mail->Username = $username; // Usuário do servidor SMTP (endereço de email)
$mail->Password = $password; // Senha do servidor SMTP (senha do email usado)
// Define o remetente

$mail->From = $from;
$mail->Sender = $sender;
$mail->FromName = $fromname;

// Define os destinatário(s)
$mail->AddAddress($destinatario);

//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
// Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
//$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
// // Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->Subject = $assunto; // Assunto da mensagem
$mail->Body = $mensagem;
$mail->AltBody = $mensagem;

// Define os anexos (opcional)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->AddAttachment("/home/login/documento.pdf", "novo_nome.pdf");  // Insere um anexo


// Envia o e-mail
$enviado = $mail->Send();

// Limpa os destinatários e os anexos
$mail->ClearAllRecipients();
$mail->ClearAttachments();

// Exibe uma mensagem de resultado
if ($enviado) {
    echo "E-mail enviado com sucesso!";
} else {
    echo "Não foi possível enviar o e-mail.
 
";
    echo "Informações do erro: 
" . $mail->ErrorInfo;
}
?>
