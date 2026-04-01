<?php

namespace App\Services;

use App\Models\Buku;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BukuService
{
    public function validate(Buku $model): void
    {
        $validator = Validator::make($model->toArray(), [
            'kode_buku' => 'required|string|max:255',
            'judul_buku' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun' => 'required|string|max:255',
            'stok' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'lokasi_rak' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|string|max:255',
        ], [
            'kode_buku.required' => 'Kode buku tidak boleh kosong!',
            'judul_buku.required' => 'Judul buku tidak boleh kosong!',
            'pengarang.required' => 'Pengarang tidak boleh kosong!',
            'penerbit.required' => 'Penerbit tidak boleh kosong!',
            'tahun.required' => 'Tahun tidak boleh kosong!',
            'stok.required' => 'Stok tidak boleh kosong!',
            'kategori.required' => 'Kategori tidak boleh kosong!',
            'lokasi_rak.required' => 'Lokasi Rak tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function query(array $params = []): Builder
    {
        $query = Buku::query();

        if (!empty($params['id'])) {
            $query->where('id', $params['id']);
        }

        if (!empty($params['judul_buku'])) {
            $query->where('judul_buku', 'like', '%' . $params['judul_buku'] . '%');
        }

        if (!empty($params['order_by'])) {
            foreach ($params['order_by'] as $column => $direction) {
                $query->orderBy($column, $direction);
            }
        } else {
            $query->orderBy('judul_buku', 'asc');
        }

        return $query;
    }

    public function findOne(array $params): ?Buku
    {
        return $this->query($params)->first();
    }

    public function findAll(array $params = []): Collection
    {
        return $this->query($params)->get();
    }

    public function findById(int|string $id): ?Buku
    {
        return $this->findOne(['id' => $id]);
    }

    public function create(Buku $model): Buku
    {
        $this->validate($model);
        $model->save();

        return $model;
    }

    public function createWithImage(Buku $model, $image = null): Buku
    {
        $this->validate($model);

        if ($image) {
            $model->image = $image->store('buku', 'public');
        }

        $model->save();

        return $model;
    }

    public function update(Buku $model): Buku
    {
        $this->validate($model);
        $model->save();

        return $model;
    }

    public function updateWithImage(Buku $model, $image = null): Buku
    {
        $this->validate($model);

        if ($image) {
            $this->deleteImage($model);
            $model->image = $image->store('buku', 'public');
        }

        $model->save();

        return $model;
    }

    public function delete(Buku $model): bool
    {
        $this->deleteImage($model);

        return $model->delete();
    }

    public function deleteImage(Buku $model): void
    {
        if ($model->image && Storage::disk('public')->exists($model->image)) {
            Storage::disk('public')->delete($model->image);
        }
    }
}