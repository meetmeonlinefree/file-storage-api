<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\UploadedFile;
use App\Models\ClientStorage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
            'type' => 'required|in:leads,deals,tasks,products,chats',
            'client_code' => 'required|string',
            'file_unique_id' => 'required|string|unique:uploaded_files,file_unique_id',
        ]);

        $path = "uploads/{$request->client_code}/{$request->type}";
        $storedPath = $request->file('file')->store($path);
        $size = $request->file('file')->getSize();

        $file = UploadedFile::create([
            'client_code' => $request->client_code,
            'type' => $request->type,
            'file_unique_id' => $request->file_unique_id,
            'path' => $storedPath,
            'filename' => $request->file('file')->getClientOriginalName(),
            'size_bytes' => $size,
        ]);

        $this->updateClientStorage($request->client_code, $size);

        return response()->json([
            'id' => $file->id,
            'file_unique_id' => $file->file_unique_id,
            'path' => $file->path,
            'size' => $file->size_bytes
        ]);
    }

    public function uploadBase64(Request $request)
    {
        $request->validate([
            'file_base64' => 'required|string',
            'type' => 'required|in:leads,deals,tasks,products,chats',
            'client_code' => 'required|string',
            'filename' => 'required|string',
            'file_unique_id' => 'nullable|string|unique:uploaded_files,file_unique_id',
        ]);

        $fileUniqueId = $request->file_unique_id ?? Str::uuid()->toString();

        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->file_base64));

        $path = "uploads/{$request->client_code}/{$request->type}/{$fileUniqueId}_{$request->filename}";
        Storage::put($path, $data);
        $size = Storage::size($path);

        $file = UploadedFile::create([
            'client_code' => $request->client_code,
            'type' => $request->type,
            'file_unique_id' => $fileUniqueId,
            'path' => $path,
            'filename' => $request->filename,
            'size_bytes' => $size,
        ]);

        $this->updateClientStorage($request->client_code, $size);

        return response()->json([
            'id' => $file->id,
            'file_unique_id' => $file->file_unique_id,
            'path' => $file->path,
            'size' => $file->size_bytes
        ]);
    }

    public function getFileByUniqueId($code)
    {
        $file = UploadedFile::where('file_unique_id', $code)->firstOrFail();
        return Storage::download($file->path, $file->filename);
    }

    public function getFileById($id)
    {
        $file = UploadedFile::findOrFail($id);
        return Storage::download($file->path, $file->filename);
    }

    public function getFiles(Request $request)
    {
        $request->validate(['client_code' => 'required|string']);

        $query = UploadedFile::where('client_code', $request->client_code);

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        return response()->json($query->get([
            'id', 'file_unique_id', 'type', 'size_bytes', 'path', 'filename', 'created_at'
        ]));
    }

    private function updateClientStorage($clientCode, $addedSize)
    {
        $storage = ClientStorage::firstOrCreate(['client_code' => $clientCode]);
        $storage->increment('size_bytes', $addedSize);
    }
}
