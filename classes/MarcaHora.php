<?php
include_once 'usuarios.php';
include_once 'HorasDiarias.php';
?>
<form id="formulario-hora" accept-charset="utf-8" method="post">
    <input type="hidden" name="" value="" />
    <div class="form-all-hora" style="margin-top: 10px">
        <ul class="form-section" style="margin-top: 80px;">

            <li class="form-line form-line-column"  >
                <label class="form-label-top"for="ra" style="margin-top: 10px">
                    RA
                </label>

                <input type="number" class="form-number-input  form-textbox validate[required]" name="ra" style="width:60px" size="5" value="" data-type="input-number" data-numbermin="5" />
                <input type="submit" name="pesquisar" value="Pesquisar"/>
            </li>

            <div  style="margin-top: 10px; height: 50px; box-sizing: 3px; ">

                <?php
                if (isset($_POST['pesquisar'])):
                    $ra = $_POST['ra'] ? $_POST['ra'] : "";

                    $user = new funcionario();
                    $user->seleciona($user);


                    while ($res = $user->retornaDados()):
                        $result = null;
                        $nome = null;
                        $resultra = null;
                        if ($ra == $res->ra):
                            $result = TRUE;
                            $resultra = $res->ra;
                            $nome = $res->nome;
                            break;
                        else:
                            $result = FALSE;
                        endif;
                    endwhile;

                    if ($result != TRUE):
                        echo 'Aluno não encontrado!';

                    else:
                        echo 'Aluno: ' . $nome . '</br></br> RA: ' . $resultra;
                    endif;

                    if (isset($_POST['registrar'])):

                        $data = $_POST['data'] ? $_POST['data'] : "";
                        $entrada = $_POST['entrada'] ? $_POST['entrada'] : "";
                        $saida = $_POST['saida'] ? $_POST['saida'] : "";
                        $minutos = $_POST['minutos'] ? $_POST['minutos'] : "";
                        $minutos2 = $_POST['minutos2'] ? $_POST['minutos2'] : "";


                        $novo = new HorasDiarias(array(
                            'id' => $data,
                            'ra' => $ra,
                            'entrada' => $entrada,
                            'saida' => $saida,
                            'minutos' => $minutos,
                            'minutos2' => $minutos2,
                        ));



                    endif;

                endif;
                ?>

            </div>
            <label class="form-label-top"  for="">
                <h6>Exemplo:30/12/91</h6>
                Data<span class="form-required">*</span>
                <input type="date" name="data" size="2" maxlength="9"style=""/>
            </label>
            <label class="form-label-top"  for="">
                Horário<span class="form-required">*</span>
            </label>
            <select class="" style="width:70px" id="input_43" name="horario1">
                <option value="8">8:00</option>
                <option value="9">9:00</option>
                <option value="10">10:00</option>
                <option value="11">11:00</option>
                <option value="12">12:00</option>                     
            </select>
            ás
            <select class="" style="width:70px" id="input_43" name="horario2">
                <option value="13">13:00</option>
                <option value="14">14:00</option>
                <option value="15">15:00</option>
                <option value="16">16:00</option>
                <option value="17">17:00</option>                     
            </select> 


            <div class="form-input-wide">
                <div style="margin-left:250px; margin-top: 30px; position: absolute" class="form-buttons-wrapper">
                    <input type="submit" class="form-submit-button" name="sair" onclick="location.href = '?m=usuarios&t=alunos'" value="Sair">
                    <input type="submit" class="form-submit-button" name="registrar" value="Registrar">
                </div>
            </div>

        </ul>
    </div>
</form> 