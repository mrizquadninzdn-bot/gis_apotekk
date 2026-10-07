<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelApotek;

class Api extends BaseController
{
    // Ubah kolom latitude & longitude (teks) menjadi angka lat & lng
    private function formatRow(array $row): array
    {
        $lat = trim((string) ($row['latitude'] ?? ''));
        $lng = trim((string) ($row['longitude'] ?? ''));

        $row['lat'] = is_numeric($lat) ? (float) $lat : null;
        $row['lng'] = is_numeric($lng) ? (float) $lng : null;

        // geojson wilayah ukurannya besar, tidak perlu ikut di data apotek
        unset($row['geojson']);

        return $row;
    }

    // GET /api/apotek -> semua apotek (JSON biasa)
    public function index()
    {
        $model = new ModelApotek();
        $data  = array_map([$this, 'formatRow'], $model->getApiApotek());

        return $this->response->setJSON([
            'status' => 200,
            'total'  => count($data),
            'data'   => $data,
        ]);
    }

    // GET /api/apotek/1 -> detail 1 apotek
    public function show($id = null)
    {
        $model = new ModelApotek();
        $row   = $model->DetailData($id);

        if (!$row) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => 404,
                'message' => 'Data apotek tidak ditemukan',
            ]);
        }

        return $this->response->setJSON([
            'status' => 200,
            'data'   => $this->formatRow($row),
        ]);
    }

    // GET /api/apotek/geojson -> format GeoJSON untuk Leaflet
    public function getApotek()
    {
        $model = new ModelApotek();

        $features = [];
        foreach ($model->getApiApotek() as $row) {
            $row = $this->formatRow($row);

            // Lewati data tanpa koordinat valid
            if ($row['lat'] === null || $row['lng'] === null) {
                continue;
            }

            $features[] = [
                'type'     => 'Feature',
                'geometry' => [
                    'type'        => 'Point',
                    // Format GeoJSON wajib: [Longitude, Latitude]
                    'coordinates' => [$row['lng'], $row['lat']],
                ],
                'properties' => [
                    'id'             => $row['id_apotek'],
                    'nama_apotek'    => $row['nama_apotek'] ?? '',
                    'status'         => $row['status'] ?? '',
                    'jenjang'        => $row['jenjang'] ?? '',
                    'alamat'         => $row['alamat'] ?? '',
                    'foto'           => $row['foto'] ?? '',
                    'marker'         => $row['marker'] ?? '',
                    'nama_provinsi'  => $row['nama_provinsi'] ?? '',
                    'nama_kabupaten' => $row['nama_kabupaten'] ?? '',
                    'nama_kecamatan' => $row['nama_kecamatan'] ?? '',
                ],
            ];
        }

        return $this->response->setJSON([
            'type'     => 'FeatureCollection',
            'features' => $features,
        ]);
    }
}