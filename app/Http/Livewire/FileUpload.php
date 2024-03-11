<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileUpload extends Component
{
    use WithFileUploads;

    public string $name;

    public string $friendly_name;

    public string $current_path;

    #[Rule('video|max:50480')]
    public $file;

    public string $file_name;

    public string $file_path;

    public string $format;

    public function updatedFile()
    {
        Storage::delete($this->current_path);
        $this->file_path = $this->file->store('public');
    }

    public function mount()
    {
        $this->file_name = $this->getFileName($this->current_path);
        $this->format = $this->getFormat($this->current_path);
    }

    private function getFileName(string $path): string
    {
        if (str_contains($path, DIRECTORY_SEPARATOR)) {
            $dirArray = explode(DIRECTORY_SEPARATOR, $path);
            return $dirArray[count($dirArray) - 1];
        }

        return $path;
    }
    private function getFormat(string $path): string
    {
        $file_name = $this->getFileName($path);

        if (str_contains($file_name, '.')){
            $fileNameArray = explode('.', $file_name);
            return $fileNameArray[count($fileNameArray) -1];
        }

        return '';
    }

    public function render()
    {
        return view('livewire.file-upload');
    }
}
