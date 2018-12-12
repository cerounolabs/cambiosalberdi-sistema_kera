<?php
    function getRealIP() {
        if (isset($_SERVER["HTTP_CLIENT_IP"])){
            return $_SERVER["HTTP_CLIENT_IP"];
        }elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }elseif (isset($_SERVER["HTTP_X_FORWARDED"])){
            return $_SERVER["HTTP_X_FORWARDED"];
        }elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){
            return $_SERVER["HTTP_FORWARDED_FOR"];
        }elseif (isset($_SERVER["HTTP_FORWARDED"])){
            return $_SERVER["HTTP_FORWARDED"];
        }else{
            return $_SERVER["REMOTE_ADDR"];
        }
    }

    function getGiroFecha($str_fecha) {
        $dataPersona    = array();
        $suc_array      = array(
            "CASA MATRIZ"               => "192.168.0.200:aliadocambios",
            "SUC. VILLA MORRA"          => "10.168.196.130:aliadocambios",
            "AGE. SAN LORENZO"          => "10.168.191.130:aliadocambios",
            "SUC. CIUDAD DEL ESTE"      => "10.168.192.138:aliadocambios",
            "AGE. JEBAI"                => "10.168.193.130:aliadocambios",
            "AGE. LAI LAI"              => "10.168.194.130:aliadocambios",
            "AGE. UNIAMERICA"           => "10.168.199.131:aliadocambios",
            "AGE. RUBIO ÑU"             => "10.168.195.130:aliadocambios",
            "AGE. KM4"                  => "10.168.190.130:aliadocambios",
            "SUC. SALTO DEL GUAIRA"     => "10.168.198.130:aliadocambios",
            "AGE. SALTO DEL GUAIRA"     => "10.168.197.130:aliadocambios",
            "SUC. ENCARNACION"          => "10.168.189.130:aliadocambios"
        );
    
        foreach($suc_array as $suc_key => $suc_ip) {
            $str_db         = $suc_ip;
            $str_user       = 'sysdba';
            $str_pass       = 'dorotea';
            $str_conn       = ibase_connect($str_db, $str_user, $str_pass) OR DIE("NO SE CONECTO AL SERVIDOR: ".ibase_errmsg());
            $wSQL00         = ibase_query("SELECT t1.ID_TRANSACCION, t1.FECHATRANSACCION, t1.HORA, t1.ESTADO, t2.CODIGO_UNICO, CASE WHEN (t2.APELLIDO <> '') THEN t2.APELLIDO || ', ' || t2.NOMBRE ELSE t2.RAZONSOCIAL END, t3.OFICINAPAGO, t4.CODIGO_UNICO, t4.RAZONSOCIAL, t7.ABREVIACION, t5.IMPORTEME, t5.IMPORTEMN
                                                FROM TRANSACCIONES t1
                                                LEFT JOIN PERSONAS t2 ON t2.ID_PERSONA = t1.ID_PERSONA
                                                LEFT JOIN TRANSFERENCIASSALIENTES t3 ON t3.ID_TRANSACCION = t1.ID_TRANSACCION
                                                LEFT JOIN PERSONAS t4 ON t4.ID_PERSONA = t3.ID_BENEFICIARIO
                                                LEFT JOIN TRANSACCIONESDETALLES t5 ON t5.ID_TRANSACCION=t1.ID_TRANSACCION
                                                LEFT JOIN COTIZACIONESMONEDAS t6 ON t6.ID_COTIZACIONMONEDA = t5.ID_COTIZACIONMONEDA
                                                LEFT JOIN MONEDAS t7 ON t7.ID_MONEDA = t6.ID_MONEDA
                                                LEFT JOIN TIPOSESPECIES t8 ON t8.ID_TIPOESPECIE = t5.ID_TIPOESPECIE
                                                LEFT JOIN TIPOSOPERACIONES t9 ON t9.ID_TIPOOPERACION = t1.ID_TIPOOPERACION
                                                WHERE t1.FECHATRANSACCION = '$str_fecha' AND t1.ESTADO = 'L' AND t5.OP = 'V' AND t8.DESCRIPCION CONTAINING 'TRANSF' AND t9.CODIGO <> '99'
                                                ORDER BY t1.FECHATRANSACCION", $str_conn);
        
            while ($row00 = ibase_fetch_row($wSQL00)) {
                $fecha  = substr($row00[1], 8, 2).'/'.substr($row00[1], 5, 2).'/'.substr($row00[1], 0, 4);
                $hora   = substr($row00[2], 11, 8);
                $data[] = array("transaccion_codigo" => $row00[0], "transaccion_fecha" => $fecha, "transaccion_hora" => $hora, "transaccion_estado" => $row00[3], "transaccion_moneda_codigo" => $row00[9], "transaccion_importe_extranjera" => $row00[10], "transaccion_importe_nacional" => $row00[11], 
                "origen_sucursal_nombre" => $suc_key, "origen_persona_codigo" => $row00[4], "origen_persona_nombre" => $row00[5],
                "destino_sucursal_nombre" => $row00[6], "destino_persona_codigo" => $row00[7], "destino_persona_nombre" => $row00[8]);
            }

            ibase_free_result($wSQL00);
            ibase_close($str_conn);
        }

        return $data;
    }

    function getBeneficiarioDoc($str_documento) {
        $tFecha         = date('Y-m-01');
        $dataPersona    = array();
        $suc_array      = array(
            "CASA MATRIZ"               => "192.168.0.200:aliadocambios",
            "SUC. VILLA MORRA"          => "10.168.196.130:aliadocambios",
            "AGE. SAN LORENZO"          => "10.168.191.130:aliadocambios",
            "SUC. CIUDAD DEL ESTE"      => "10.168.192.138:aliadocambios",
            "AGE. JEBAI"                => "10.168.193.130:aliadocambios",
            "AGE. LAI LAI"              => "10.168.194.130:aliadocambios",
            "AGE. UNIAMERICA"           => "10.168.199.131:aliadocambios",
            "AGE. RUBIO ÑU"             => "10.168.195.130:aliadocambios",
            "AGE. KM4"                  => "10.168.190.130:aliadocambios",
            "SUC. SALTO DEL GUAIRA"     => "10.168.198.130:aliadocambios",
            "AGE. SALTO DEL GUAIRA"     => "10.168.197.130:aliadocambios",
            "SUC. ENCARNACION"          => "10.168.189.130:aliadocambios"
        );
    
        foreach($suc_array as $suc_key => $suc_ip) {
            $str_db         = $suc_ip;
            $str_user       = 'sysdba';
            $str_pass       = 'dorotea';
            $str_conn       = ibase_connect($str_db, $str_user, $str_pass) OR DIE("NO SE CONECTO AL SERVIDOR: ".ibase_errmsg());
            $wSQL00         = ibase_query("SELECT t1.ID_TRANSACCION, t1.FECHATRANSACCION, t1.HORA, t1.ESTADO, t2.CODIGO_UNICO, CASE WHEN (t2.APELLIDO <> '') THEN t2.APELLIDO || ', ' || t2.NOMBRE ELSE t2.RAZONSOCIAL END, t3.OFICINAPAGO, t4.CODIGO_UNICO, t4.RAZONSOCIAL, t7.ABREVIACION, t5.IMPORTEME, t5.IMPORTEMN
                                                FROM TRANSACCIONES t1
                                                LEFT JOIN PERSONAS t2 ON t2.ID_PERSONA = t1.ID_PERSONA
                                                LEFT JOIN TRANSFERENCIASSALIENTES t3 ON t3.ID_TRANSACCION = t1.ID_TRANSACCION
                                                LEFT JOIN PERSONAS t4 ON t4.ID_PERSONA = t3.ID_BENEFICIARIO
                                                LEFT JOIN TRANSACCIONESDETALLES t5 ON t5.ID_TRANSACCION=t1.ID_TRANSACCION
                                                LEFT JOIN COTIZACIONESMONEDAS t6 ON t6.ID_COTIZACIONMONEDA = t5.ID_COTIZACIONMONEDA
                                                LEFT JOIN MONEDAS t7 ON t7.ID_MONEDA = t6.ID_MONEDA
                                                LEFT JOIN TIPOSESPECIES t8 ON t8.ID_TIPOESPECIE = t5.ID_TIPOESPECIE
                                                LEFT JOIN TIPOSOPERACIONES t9 ON t9.ID_TIPOOPERACION = t1.ID_TIPOOPERACION
                                                WHERE t1.FECHATRANSACCION >= '$tFecha' AND t1.ESTADO = 'L' AND t4.CODIGO_UNICO = '$str_documento' AND t5.OP = 'V' AND t8.DESCRIPCION CONTAINING 'TRANSF' AND t9.CODIGO <> '99'
                                                ORDER BY t1.ID_TRANSACCION DESC", $str_conn);
        
            while ($row00 = ibase_fetch_row($wSQL00)) {
                $fecha  = substr($row00[1], 8, 2).'/'.substr($row00[1], 5, 2).'/'.substr($row00[1], 0, 4);
                $hora   = substr($row00[2], 11, 8);
                $data[] = array("transaccion_codigo" => $row00[0], "transaccion_fecha" => $fecha, "transaccion_hora" => $hora, "transaccion_estado" => $row00[3], "transaccion_moneda_codigo" => $row00[9], "transaccion_importe_extranjera" => $row00[10], "transaccion_importe_nacional" => $row00[11], 
                "origen_sucursal_nombre" => $suc_key, "origen_persona_codigo" => $row00[4], "origen_persona_nombre" => $row00[5],
                "destino_sucursal_nombre" => $row00[6], "destino_persona_codigo" => $row00[7], "destino_persona_nombre" => $row00[8]);
            }

            ibase_free_result($wSQL00);
            ibase_close($str_conn);
        }

        return $data;
    }
?>