<?php

add_shortcode('show_request_a_quote_one_page','request_a_quote_one_page');

function request_a_quote_one_page(){
    

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 100,
    );

    $query = new WC_Product_Query( $args );
    $products = $query->get_products();
    ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <form id="request_a_quote_form" name="request_a_quote_form" action="" method="POST">
        <div class="request_a_quote_table ">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th class="product_name_header">Producto</th>
                    <th class="product_large_header">Largo (m)</th>
                    <th class="product_weight_header">Peso aproximado (kg)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($products as $prod){
                ?>
                <tr class="product_row_pw">
                    <input type="hidden" name="prods_id[<?= $prod->get_id() ?>]" value="<?= $prod->get_id()?>">
                    <td><input name="enableds[<?= $prod->get_id() ?>]" type="checkbox" onchange="toggleInputs(this)"></td>
                    <td><input type="hidden" name="prods_name[<?= $prod->get_id() ?>]" value="<?= $prod->get_name() ?>"> <span class="fs-5"><?=$prod->get_name() ?></span></td>
                    <td> <input  name="larges[<?= $prod->get_id() ?>]" type="number" step="0.1" class="form-control" disabled> metros </td>
                    <td> <input name="weights[<?= $prod->get_id() ?>]" type="number" step="0.5" class="form-control" disabled> kg </td>
                </tr>
                <?php
                }
                ?>

            </tbody>
        </table>

        <div class="row mb-3">
            <div class="col">
                <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre y apellido" aria-label="Nombre y apellido">
            </div>
            <div class="col">
                <input  id="empresa" name="empresa" type="text" class="form-control" placeholder="Empresa (opc)" aria-label="Empresa">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input id="email" name="email" type="email" class="form-control" placeholder="Email" aria-label="Email" required>
            </div>
            <div class="col">
                <input id="telefono" name="telefono" type="tel" class="form-control mb-3" placeholder="Telefono (opc)" aria-label="Telefono (opc)">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="whatsapp" name="whatsapp">
                    <label class="checkbox_whatsapp" for="whatsapp">WhatsApp?</label>
                </div>


            </div>
        </div>
        <div class="row mb-3">
        <textarea placeholder="Mensaje adicional (opc)" id="mensaje_adicional" name="mensaje_adicional" class="form-control fs-4"></textarea>
        </div>
        <div class="row mb-3">
            <input type="submit" id="submit" name="submit" value="Solicitar cotización">
        </div>



        </div>
    </form>

    <script>
        function toggleInputs(checkbox) {
            var inputs = checkbox.parentNode.parentNode.getElementsByTagName('input');
            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].type !== 'checkbox') {
                    inputs[i].disabled = !checkbox.checked;
                }
            }
        }
    </script>

    <?php

    include('send_mail.php');


}