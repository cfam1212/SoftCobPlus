<?php
    function post_importar_csv()
    {
    try {
        if (!check_posted_data(['csrf'], $_POST) || !Csrf::validate($_POST["csrf"])) {
        throw new Exception("Acceso no autoritzado.");
        }

        // Incializamos variables
        $rows     = [];
        $total    = 0;
        $inserted = 0;
        $errors   = 0;

        // Validación de que haya archivos llegando a la ruta
        if (!isset($_FILES["archivo"])) {
        throw new Exception("Selecciona un archivo CSV válido.");
        }

        // Información del archivo CSV
        $file     = $_FILES["archivo"];
        $tmp      = $file["tmp_name"];
        $filename = $file["name"];
        $size     = $file["size"];
            $ext      = pathinfo($filename, PATHINFO_EXTENSION);

        // Validar la extensión de archivo en backend
        if (!in_array($ext, ['csv','CSV'])) {
        throw new Exception("Selecciona un archivo válido por favor.");
        }

        // Validar el tamaño válido del archivo
        if ($size < 0) {
        throw new Exception("Selecciona un archivo válido por favor.");
        }

        // Inicializamos la lectura del archivo
        $handle = fopen($tmp, "r");

        // Leemos cada fila y la agregamos a un array
        while (($data = fgetcsv($handle)) !== false) {
        $rows[] = $data;
        }

        // se eliminan las cabeceras y contamos el total de filas
        unset($rows[0]); 
        $total = count($rows);
        
        // Si no hay filas no importamos nada
        if ($total <= 0) {
        throw new Exception("El archivo proporcionado está vacio.");
        }

        // Insertando información
        foreach ($rows as $r) {
        $data =
        [
            'titulo'      => $r[0],
            'contenido'   => $r[1],
            'creado'      => now(),
            'actualizado' => now()
        ];

        // Se agrega el registro a la base de datos
        if (Model::add('posts', $data) === false) {
            $errors++;
            continue;
        }

        $inserted++;
        }

        // Notificación de elementos insertados en db
        Flasher::new(sprintf('Se han insertado <b>%s</b> de <b>%s</b> registros con éxito.', $inserted, $total), 'success');

        // Si hubo 1 o más errores
        if ($errors > 0) {
        Flasher::new(sprintf('Tuvimos problemas al importar <b>%s</b> registros.', $errors), 'danger');
        }

        // Redirección
        Redirect::back();

    } catch (Exception $e) {
        Flasher::new($e->getMessage(), 'danger');
        Redirect::back();
    }
    }

?>