<?php
protegerArquivo(basename(__FILE__));
@$sessao = new sessao;
if (isAdmin() == true || $sessao->getVar('ra') == $_GET['ra']):
    if (isset($_GET['ra'])):
        $ra = $_GET['ra'];
        if (isset($_POST['adicionar'])):
            $admin = (isset($_POST['admin'])) ? $_POST['admin'] : "";
            $ativo = (isset($_POST['ativo'])) ? $_POST['ativo'] : "";

            $rodizio = new Rodizio(array(
             
                'nome'=>'Novo', 
                'data'=> '10/10/2013', 
                'alunos'=> $ra
            ));
          
            $rodizio->inserir($rodizio);
            if ($rodizio->linhasAfetadas == 1):
                exibirMensagem('Aluno adicionado com sucesso.<a href="?m=usuarios&t=listaatual">Exibir Cadastros</a>','sucesso');
                unset($_POST);
            else:
                exibirMensagem('Nenhum dado alterado.<a href="?m=usuarios&t=listaatual">Exibir Cadastros</a>', 'alerta');

            endif;

        endif;
        $ra = $_GET['ra'];
        $userbd = new funcionario();
        $userbd->extras_select = " WHERE ra=$ra";
        $userbd->seleciona($userbd);
        $resbd = $userbd->retornaDados();

    else:
        exibirMensagem('Usuario indefinido.<a href="?m=usuarios&t=listar">Escolha um usuario para alterar</a>', 'erro');
    endif;
    ?>
    <script>


    </script> 
    <form id="formCadastro"action="" name="" method="post" >
        <fieldset>
            <legend>
                </br>
                Verifique os dados para adicionar á lista de rodízio</legend>
            <ul>
                <li><label  for="nome">Nome:</label></li>                  
                <li><input disabled="disabled" id="nome" type="text" name="nome" size="25" value="<?php if ($resbd) echo $resbd->nome ?>" /></li>
                <label for="sobrenome">Sobrenome: </label>
                <li><input disabled="disabled"id="sobreme"  type="text" name="sobrenome" size="25" value=" <?php if ($resbd) echo $resbd->sobrenome ?> "/></li>
                <li><label for="ra">RA:</label></li>
                <li><input  type="text" name="ra"size="25" value=" <?php if ($resbd) echo $resbd->ra ?>"/></li>
                <li><label for="telefone">Telefone:</label></li>
                <li><input disabled="disabled"id="telefone"type="text" name="telefone"size="25" value=" <?php if ($resbd) echo $resbd->telefone ?>"/></li>
                <li><label for="ramal">Ramal:</label></li>
                <li><input disabled="disabled"id="ramal"type="text" name="ramal" size="25"value=" <?php if ($resbd) echo $resbd->ramal ?> "/></li>
                <li><label for="curso">Curso:</label></li>
                <li><input disabled="disabled"id="curso"type="text" name="curso" size="25"value="  <?php if ($resbd) echo $resbd->curso ?>"/></li>
                <li><label for="email">Email:</label></li>
                <li><input disabled="disabled" id="email"type="text" name="email" size="25"value=" <?php if ($resbd) echo $resbd->email ?>"/></li>
                <li><label for="ativo">Ativo:</label></li>
                <li><input disabled="disabled"type="checkbox" name="ativo" <?php if ($resbd->ativo == 's') echo "checked='checked'"; ?>/> <li>
                <li><label for="admin">Administrador:</label></li>
                <li><input disabled="disabled" type="checkbox" name="admin" <?php if ($resbd->admin == 's') echo "checked='checked'"; ?>/><li>             

                <li class="center"><input type="button" onclick="location.href = '?m=usuarios&t=alunos'" value="Sair"/>
                    <input type="submit" name="adicionar" value="Adicionar" /></li>
            </ul>
        </fieldset>
    </form>
    <?php
else:
    exibirMensagem('Voce não tem permissão para acessar a pagina<a href="#" onclick="history.back()">Voltar</a>', 'erro');
 endif;