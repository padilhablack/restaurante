
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
    <form id = "formMensagem"action="../classes/mail.php" method="post" name=""  accept-charset="utf-8">
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
                                <button  type="submit" class="form-submit-button-mensagem">
                                    Enviar
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
            </fieldset>
        </div>
    </form>
</div>

</form>