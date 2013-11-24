<?php
@$sessao = new sessao;
if (isAdmin() == true || $sessao->getVar('ra') == $_GET['ra']):
    if (isset($_GET['ra'])):
        $ra = $_GET['ra'];
        if (isset($_POST['editar'])):
            $admin = (isset($_POST['admin'])) ? $_POST['admin'] : "";
            $ativo = (isset($_POST['ativo'])) ? $_POST['ativo'] : "";

            $user = new funcionario(array(
                'nome' => $_POST['nome'],
                'sobrenome' => $_POST['sobrenome'],
                'telefone' => $_POST['telefone'],
                'ra' => $_POST['ra'],
                'ramal' => $_POST['ramal'],
                'curso' => $_POST['curso'],
                'email' => $_POST['email'],
                'ativo' => ($ativo == 'on') ? 's' : 'n',
                'admin' => ($admin == 'on') ? 's' : 'n'
            ));
            $duplicado = null;
            $user->valorpk = $ra;
            $user->extras_select = "WHERE ra=$ra";
            $user->seleciona($user);
            $res = $user->retornaDados();

            if ($res->email != $_POST['email']):
                if ($user->existeRegistro('email', $_POST['email'])):
                    exibirMensagem('Este email ja existe, escolha outro endereço', 'erro');
                    $duplicado = true;
                endif;
            endif;

            if ($duplicado != true):
                $user->atualizar($user);
                if ($user->linhasAfetadas == 1):
                    exibirMensagem('Dados alterados com sucesso.<a href="?m=usuarios&t=pesquisar">Exibir Cadastros</a>');
                    unset($_POST);
                else:
                    exibirMensagem('Nenhum dado alterado.<a href="?m=usuarios&t=pesquisar">Exibir Cadastros</a>', 'alerta');

                endif;

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
            <ul>
                <li><label for="nome">Nome:</label></li>                  
                <li><input type="text" name="nome" size="25" value="<?php if ($resbd) echo $resbd->nome; ?>" /></li>
                <li><label for="sobrenome">Sobrenome: </label></li>
                <li><input type="text" name="sobrenome" size="25" value=" <?php if ($resbd) echo $resbd->sobrenome; ?> "/></li>
                <li><label for="ra">RA:</label></li>
                <li><input type="text" name="ra"size="25" value=" <?php if ($resbd) echo $resbd->ra; ?>"/></li>
                <li><label for="telefone">Telefone:</label></li>
                <li><input type="text" name="telefone"size="25" value=" <?php if ($resbd) echo $resbd->telefone; ?>"/></li>
                <li><label for="ramal">Ramal:</label></li>
                <li><input type="text" name="ramal" size="25"value=" <?php if ($resbd) echo $resbd->ramal; ?> "/></li>
                <li><label for="curso">Curso:</label></li>
                <li><input type="text" name="curso" size="25"value="  <?php if ($resbd) echo $resbd->curso; ?> "/></li>
                <li><label for="email">Email:</label></li>
                <li><input type="text" name="email" size="25"value=" <?php if ($resbd) echo $resbd->email; ?>"/></li>
                <li><label for="admin">Administrador:</label></li>
                <li><input type="checkbox" name="admin"<?php
                    $admin = (isset($_POST['admin'])) ? $_POST['admin'] : "";
                    if (!isAdmin())
                        echo 'disabled="disabled"';
                    if ($admin)
                        echo 'checked="checked';
                    ?>/></li>
                <li><label for="admin">Ativo:</label></li>
                <li><input type="checkbox" name="admin"<?php
                    $admin = (isset($_POST['ativo'])) ? $_POST['ativo'] : "";
                    if (!isAdmin())
                        echo 'disabled="disabled"';
                    if ($admin)
                        echo 'checked="checked';
                    ?>/></li>


                <li class="center"><input type="button" onclick="location.href = '?m=usuarios&t=alunos'" value="Sair"/>
                    <input type="submit" name="editar" value="Salvar dados"/></li>

            </ul>
        </fieldset>

    </form>

    <?php
else:
    exibirMensagem('Você não tem permissão para acessar a pagina.<a href="#" onclick="history.back()">Voltar</a>');
endif;

    
    
    
    
