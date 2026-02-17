<?php
include_once(__DIR__ . '/../config/url.php');

function buscarImagemPorCategoria($categoria)
{
    $categoria = strtolower(trim($categoria));
    $cacheDir = __DIR__ . '/../cache/';
    $cacheFile = $cacheDir . "unsplash_" . $categoria . ".json";

    $tempoCache = 3600; // 1 hora

    // 🔹 1️⃣ Se cache existe e ainda é válido
    if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $tempoCache) {

        $data = json_decode(file_get_contents($cacheFile), true);

    } else {

        $url = UNSPLASH_BASE_URL .
            "photos/random?query=" . urlencode($categoria) .
            "&client_id=" . UNSPLASH_ACCESS_KEY;

        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10, // evita travar se API demorar
        ]);

        $response = curl_exec($ch);

        // 🔹 Verifica erro na requisição
        if ($response === false) {
            error_log("Erro cURL: " . curl_error($ch));
            unset($ch);
            return null;
        }

        unset($ch); // substitui curl_close (compatível com PHP 8.5)

        $data = json_decode($response, true);

        // 🔹 Se API retornou algo válido, salva no cache
        if (isset($data['urls']['regular'])) {

            if (!is_dir($cacheDir)) {
                mkdir($cacheDir, 0755, true);
            }

            file_put_contents($cacheFile, json_encode($data));
        } else {
            return null;
        }
    }

    return $data['urls']['regular'] ?? null;
}
