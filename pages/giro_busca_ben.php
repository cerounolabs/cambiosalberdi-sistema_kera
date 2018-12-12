<?php
    include '../class/header.php';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
<?php
  include '../incl/head.php';
?>

    </head>
    <body>
        <div class="container-scroller">
<?php
    include '../incl/menu.php';
?>
            <div class="container-fluid page-body-wrapper">
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="page-header">
                            <h1 class="page-title" style="font-size:2.19rem !important;">
                                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                    <i class="mdi mdi-home"></i>                 
                                </span>
                                BENEFICIARIO X DOCUMENTO
                            </h1>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="forms-sample">
                                                <div class="form-group">
                                                    <label for="persona"> N&Uacute;MERO DOCUMENTO </label>
                                                    <input type="text" class="form-control" style="text-transform:uppercase;" id="persona" name="persona" value="<?php echo $_GET['persona']; ?>" placeholder="N&Uacute;MERO DOCUMENTO">
                                                </div>
                                            <a type="button" class="btn btn-gradient-primary btn-fw" style="float:right; margin-bottom: .75rem; background-color: rgba(172, 50, 228, 0.9); background-image: linear-gradient(to right, #da8cff, #9a55ff);" onclick="buscaPersona()"> Consultar </a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>    
                        
                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <a type="button" class="btn btn-gradient-primary btn-fw" style="float:right; margin-bottom: .75rem; background-color: rgba(172, 50, 228, 0.9); background-image: linear-gradient(to right, #da8cff, #9a55ff);" href="#" onclick="exportToExcel('exTable')"><i class="mdi mdi-file-excel "></i> Exportar a Excell</a>
                                        <table id="exTable" class="table table-striped" border="1">
                                            <thead>
                                                <tr valign="middle">
                                                    <th style="text-align:center;" colspan="3"> TRANSACCI&Oacute;N </th>
                                                    <th style="text-align:center;" colspan="3"> ORIGEN </th>
                                                    <th style="text-align:center;" colspan="3"> DESTINO </th>
                                                    <th style="text-align:center;" colspan="3"> IMPORTE </th>
                                                </tr>
                                                <tr valign="middle">
                                                    <th style="text-align:center;"> NRO </th>
                                                    <th style="text-align:center;"> ID </th>
                                                    <th style="text-align:center;"> FECHA HORA </th>
                                                    <th style="text-align:center;"> SUCURSAL </th>
                                                    <th style="text-align:center;"> C&Oacute;DIGO </th>
                                                    <th style="text-align:center;"> PERSONA </th>
                                                    <th style="text-align:center;"> SUCURSAL </th>
                                                    <th style="text-align:center;"> C&Oacute;DIGO </th>
                                                    <th style="text-align:center;"> PERSONA </th>
                                                    <th style="text-align:center;"> MONEDA </th>
                                                    <th style="text-align:center;"> ME </th>
                                                    <th style="text-align:center;"> MN </th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
    $item   = 0;
    if (isset($_GET['persona'])) {
        $arr_result = getBeneficiarioDoc($_GET['persona']);
        
        foreach($arr_result as $dat_result) {
            $item   = $item + 1;
?>
                                                <tr>
                                                    <td style="text-align:right;">  <?php echo $item; ?> </td>
                                                    <td style="text-align:left;">   <?php echo $dat_result['transaccion_codigo']; ?> </td>
                                                    <td style="text-align:left;">   <?php echo $dat_result['transaccion_fecha'].' '.$dat_result['transaccion_hora']; ?> </td>
                                                    <td style="text-align:left;">   <?php echo $dat_result['origen_sucursal_nombre']; ?> </td>
                                                    <td style="text-align:left;">   <?php echo $dat_result['origen_persona_codigo']; ?> </td>
                                                    <td style="text-align:left;">   <?php echo $dat_result['origen_persona_nombre']; ?> </td>
                                                    <td style="text-align:left;">   <?php echo $dat_result['destino_sucursal_nombre']; ?> </td>
                                                    <td style="text-align:left;">   <?php echo $dat_result['destino_persona_codigo']; ?> </td>
                                                    <td style="text-align:left;">   <?php echo $dat_result['destino_persona_nombre']; ?> </td>
                                                    <td style="text-align:center;"> <?php echo $dat_result['transaccion_moneda_codigo']; ?> </td>
                                                    <td style="text-align:right;">  <?php echo number_format($dat_result['transaccion_importe_extranjera'], 0, ',', '.'); ?> </td>
                                                    <td style="text-align:right;">  <?php echo number_format($dat_result['transaccion_importe_nacional'], 0, ',', '.'); ?> </td>
                                                </tr>
<?php
        }
    }
?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php  include '../incl/footer.php'; ?>
        <script>
            function buscaPersona() {
                var persona = document.getElementById("persona").value;
                var urlGET  = "";

                if (persona !== null && persona !== '') {
                    urlGET = "http://10.168.196.152/sistema_kera/pages/giro_busca_ben.php?persona=" + persona;
                } else {
                    urlGET = "http://10.168.196.152/sistema_kera/pages/giro_busca_ben.php";
                }
                
                window.location.href    = urlGET;

            }

            function exportToExcel(tableID){
                var tab_text    ="<table border='2px'><tr bgcolor='#87AFC6' style='height: 75px; text-align: center; width: 250px'>";
                var textRange   = 0; 
                var j           = 0;
                tab             = document.getElementById(tableID);

                for(j = 0 ; j < tab.rows.length ; j++) {
                    tab_text = tab_text;
                    tab_text = tab_text+tab.rows[j].innerHTML.toUpperCase() + "</tr>";
                }

                tab_text    = tab_text + "</table>";
                tab_text    = tab_text.replace(/<A[^>]*>|<\/A>/g, "");
                tab_text    = tab_text.replace(/<img[^>]*>/gi,"");
                tab_text    = tab_text.replace(/<input[^>]*>|<\/input>/gi, "");
                
                var ua      = window.navigator.userAgent;
                var msie    = ua.indexOf("MSIE ");
                
                if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
                    txtArea1.document.open("txt/html","replace");
                    txtArea1.document.write('sep=,\r\n' + tab_text);
                    txtArea1.document.close();
                    txtArea1.focus();
                    sa = txtArea1.document.execCommand("SaveAs",true,"sudhir123.txt");
                }
                else {
                    sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
                }
                
                return (sa);
            }

            $(document).keypress(function (e) {
                if (e.which == 13) {
                    buscaPersona();
                }
            });
        </script>
    </body>
</html>