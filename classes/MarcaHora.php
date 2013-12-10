<?php
include_once 'usuarios.php';
include_once 'HorasDiarias.php';
if (isAdmin()):
    ?>
    <form id="formulario-hora" accept-charset="utf-8" method="post">
        <input type="hidden" name="" value="" />
        <div class="form-all-hora" style="margin-top: 10px;">
            <ul class="form-section" style="margin-top: 80px;">

                <li class="form-line form-line-column"  >
                    <label class="form-label-top"for="ra" style="margin-top: 10px">
                        RA
                    </label>
                    <input type="number" class="form-number-input  form-textbox validate[required]" name="ra" style="width:60px" size="5" value="" data-type="input-number" data-numbermin="5" />
                </li>

                <div  style="margin-top: 10px; height: 50px; box-sizing: 3px; ">

                    <?php
                    if (isset($_POST['registrar'])):
                        $ra = $_POST['ra'] ? $_POST['ra'] : "";
                        $data = $_POST['data'] ? $_POST['data'] : "";
                        $entrada = $_POST['horario1'] ? $_POST['horario1'] : "";
                        $saida = $_POST['horario2'] ? $_POST['horario2'] : "";
                        $minutos = $_POST['minutos'] ? $_POST['minutos'] : "";
                        $minutos2 = $_POST['minutos2'] ? $_POST['minutos2'] : "";

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
                            $novo = new HorasDiarias(array(
                                'id' => $data,
                                'data' => $data,
                                'ra' => $ra,
                                'nome' => $nome,
                                'entrada' => $entrada.":".$minutos,
                                'saida' => $saida.":".$minutos2
                                
                            ));

                            $novo->inserir($novo);
                            if ($novo->linhasAfetadas == 1):
                                echo '</br style="margin-left:50px;">Horas registradas com sucesso';
                            else:
                                echo'</br>Nenhum registro efetuado!';
                            endif;
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
                <select class="" style="width:40px" id="input_43" name="horario1">
                    <option value="8">8</option> 
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>                     
                </select>
                : 
                <select class="" style="width:50px" id="input_43" name="minutos">
                    <option value="00">00</option> 
                    <option value="01">01</option>
                    <option value="02">02</option> 
                    <option value="03">03</option> 
                    <option value="04">04</option> 
                    <option value="05">05</option> 
                    <option value="06">06</option> 
                    <option value="07">07</option> 
                    <option value="08">08</option> 
                    <option value="09">09</option> 
                    <option value="10">10</option> 
                    <option value="11">11</option> 
                    <option value="12">12</option> 
                    <option value="13">13</option> 
                    <option value="14">14</option> 
                    <option value="15">15</option>
                    <option value="16">16</option> 
                    <option value="17">17</option> 
                    <option value="18">18</option> 
                    <option value="19">19</option> 
                    <option value="20">20</option> 
                    <option value="21">21</option> 
                    <option value="22">22</option> 
                    <option value="23">23</option> 
                    <option value="24">24</option> 
                    <option value="25">25</option> 
                    <option value="26">26</option> 
                    <option value="27">27</option> 
                    <option value="28">28</option> 
                    <option value="29">29</option> 
                    <option value="30">30</option> 
                    <option value="31">31</option> 
                    <option value="32">32</option> 
                    <option value="33">33</option> 
                    <option value="34">34</option> 
                    <option value="35">35</option> 
                    <option value="36">36</option>
                    <option value="37">37</option> 
                    <option value="38">38</option> 
                    <option value="39">39</option> 
                    <option value="40">40</option> 
                    <option value="41">41</option> 
                    <option value="42">42</option> 
                    <option value="43">43</option> 
                    <option value="44">44</option> 
                    <option value="45">45</option> 
                    <option value="46">46</option> 
                    <option value="47">47</option> 
                    <option value="48">48</option> 
                    <option value="49">49</option> 
                    <option value="50">50</option> 
                    <option value="51">51</option> 
                    <option value="52">52</option> 
                    <option value="53">53</option> 
                    <option value="54">54</option> 
                    <option value="55">55</option> 
                    <option value="56">56</option> 
                    <option value="57">57</option> 
                    <option value="58">58</option> 
                    <option value="59">59</option>
                </select>
                ás
                <select class="" style="width:45px" id="input_43" name="horario2">
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>                     
                </select> 
                : 
                <select class="" style="width:50px" id="input_43" name="minutos2">
                    <option value="00">00</option> 
                    <option value="01">01</option>
                    <option value="02">02</option> 
                    <option value="03">03</option> 
                    <option value="04">04</option> 
                    <option value="05">05</option> 
                    <option value="06">06</option> 
                    <option value="07">07</option> 
                    <option value="08">08</option> 
                    <option value="09">09</option> 
                    <option value="10">10</option> 
                    <option value="11">11</option> 
                    <option value="12">12</option> 
                    <option value="13">13</option> 
                    <option value="14">14</option> 
                    <option value="15">15</option>
                    <option value="16">16</option> 
                    <option value="17">17</option> 
                    <option value="18">18</option> 
                    <option value="19">19</option> 
                    <option value="20">20</option> 
                    <option value="21">21</option> 
                    <option value="22">22</option> 
                    <option value="23">23</option> 
                    <option value="24">24</option> 
                    <option value="25">25</option> 
                    <option value="26">26</option> 
                    <option value="27">27</option> 
                    <option value="28">28</option> 
                    <option value="29">29</option> 
                    <option value="30">30</option> 
                    <option value="31">31</option> 
                    <option value="32">32</option> 
                    <option value="33">33</option> 
                    <option value="34">34</option> 
                    <option value="35">35</option> 
                    <option value="36">36</option>
                    <option value="37">37</option> 
                    <option value="38">38</option> 
                    <option value="39">39</option> 
                    <option value="40">40</option> 
                    <option value="41">41</option> 
                    <option value="42">42</option> 
                    <option value="43">43</option> 
                    <option value="44">44</option> 
                    <option value="45">45</option> 
                    <option value="46">46</option> 
                    <option value="47">47</option> 
                    <option value="48">48</option> 
                    <option value="49">49</option> 
                    <option value="50">50</option> 
                    <option value="51">51</option> 
                    <option value="52">52</option> 
                    <option value="53">53</option> 
                    <option value="54">54</option> 
                    <option value="55">55</option> 
                    <option value="56">56</option> 
                    <option value="57">57</option> 
                    <option value="58">58</option> 
                    <option value="59">59</option>
                </select>

                <div class="form-input-wide">
                    <div style="margin-left:250px; margin-top: 30px; position: absolute" class="form-buttons-wrapper">
                        <input type="button" class="form-submit-button" name="sair" onclick="location.href = 'painel.php?m=usuarios&t=horario'" value="Sair">
                        <input type="submit" class="form-submit-button" name="registrar" value="Registrar">
                    </div>
                </div>

            </ul>
        </div>
    </form> 
    <?php
else:
    exibirMensagem('Você não tem permissão para acessar essa página', 'erro');
endif;
?>
