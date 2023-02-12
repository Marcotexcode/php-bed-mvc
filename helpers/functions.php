<?php

/**
 * Questa funzione riceve la view che vogliamo renderizzare,
 * i dati che vogliamo passare alla view,
 * e la cartella dove stanno i template che di default è app/views.
 */
function view(string $view, array $data, string $viewDir = 'app/views/'): string {

    extract($data, EXTR_OVERWRITE);

    ob_start(); // Avvia buffer e permette che tutto l'output di php viene fermato e viene creato un buffer interno. 
    require $viewDir . $view . '.php'; // Prende il template del file .php.
    
    /**
     * imposta il contenuto del file. 
     * ob_get_contents() cattura il buffer cioè il file con il template che viene preso con il require.
     * e viene inserito dentro al body dell' layout/index.php. 
     */
    $content = ob_get_contents();

    /**
     *  Alla fine distruggo il buffer. 
     *  Senno viene visto sia dal template show_product che dal template layout/index,
     *  in questo modo il contenuto del file show_product viene passato in content in modo da farlo vedere
     *  in layout/index e poi il contenuto show_product.php verra cancellato in modo da non stampare a video lo 
     *  stesso contenuto. 
     */
    ob_end_clean();
    return $content;
}