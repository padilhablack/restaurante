<?php
require_once 'classes/phpmailer/class.phpmailer.php';

//dados vindos do formulario
if (isset($_POST['enviar'])):


    $nome = $_POST['nome'] ? $_POST['nome'] : "";
    $remetente = $_POST['remetente'] ? $_POST['remetente'] : "";
    $destinatario = $_POST['destinatario'] ? $_POST['destinatario'] : "";
    $assunto = $_POST['assunto'] ? $_POST['assunto'] : "";
    $mensagem = $_POST['mensagem'] ? $_POST['mensagem'] : "";


//dados do servidor

    $host = "localhost";
    $username = "root";
    $password = "popup";

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
endif;
?>

<script>
    $(document).ready(function() {
        $('#formMensagem').validate({
            rules: {// condições 
                nome: {required: true, minlength: 3},
                remetente: {required: true, email: true},
                destinatario: {required: true, email: true},
                mensagem: {required: true, mensagem: true},
            },
            messages: {// ações
                nome: {required: " <div class='alertajs'>Digite o nome.</div>",
                    minlength: " <div class='alertajs'>O campo nome deve ter no mínimo 3 caracteres</div>"},
                remetente: {
                    required: "<div class='alertajs'>O campo email é obrigatorio.</div>",
                    email: "<div class='alertajs'>O campo email deve conter um email válido.</div>"
                },
                destinatario: {
                    required: "<div class='alertajs'>O campo email de destino éobrigatório.</div>",
                    email: "<div class='alertajs'>O campo email deve conter um email válido.</div>"
                },
                mensagem: {
                    required: "<div class='alertajs'>O campo mensagem obrigatorio.</div>",
                },
            }

        });
    });

</script>

<img class="image_mensagem" src="images/carta.png"/>
<div id="mensagem">
    <form id = "formMensagem"action="" method="post" name=""  accept-charset="utf-8">
        <input type="hidden" name="formID" value="" />
        <div class="form-mensagem">
            <fieldset>
                <ul class="form-section-mensagem ">
                    <li>
                        <div class="form-header-group-mensagem">
                            <h2  class="form-header-mensagem">
                                Mensagem
                            </h2>
                        </div>
                    </li>

                    <li>
                        <label class="form-label-left-mensagem" for="nome"> Nome </label>
                        <div class="form-input">
                            <input type="text" class=" form-textbox-msn" data-type="input-textbox"  name="nome" size="20" value="" />
                        </div>
                    </li>


                    <li>
                        <label class="form-label-left-mensagem" for="remetente"> Email </label>
                        <div class="form-input">
                            <input type="text" class=" form-textbox-msn" data-type="input-textbox"  name="remetente" size="20" value="" />
                        </div>
                    </li>

                    <li>
                        <label class="form-label-left-mensagem"  for="destinatario"> Destinatário(e-mail) </label>
                        <div class="form-input">
                            <input type="text" class=" form-textbox-msn" data-type="input-textbox" name="destinatario" size="20" value="" />
                        </div>
                    </li>

                    <li>
                        <label class="form-label-left-mensagem"  for="assunto"> Assunto </label>
                        <div class="form-input">
                            <input type="text" class=" form-textbox-msn" data-type="input-textbox" name="assunto" size="20" value="" />
                        </div>
                    </li>


                    <li class="form-line-mensagem" id="id_5">
                        <label class="form-label-left-mensagem" for="mensagem"> Escreva sua mensagem </label>
                        <div id="cid_5" class="form-input">
                            <textarea  class="form-textarea-mensagem" name="mensagem" cols="40" rows="6"></textarea>
                        </div>
                    </li>
                    <li class="form-line-mensagem">
                        <div class="form-input-wide">
                            <div style="margin-left:156px" class="form-buttons-wrapper-mensagem">
                                <input  type="submit" name="enviar" value="Enviar">

                            </div>
                        </div>
                    </li>
                </ul>
            </fieldset>
        </div>
    </form>
</div>

</form>