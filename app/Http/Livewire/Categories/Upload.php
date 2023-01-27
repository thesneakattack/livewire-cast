<?php

namespace App\Http\Livewire\Categories;

use App\Models\LflbCategory;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public LflbCategory $category;
    public $upload;

    protected $rules = [
        'category.username' => 'max:24',
        'category.about' => 'max:140',
        'category.birthday' => 'sometimes',
        'upload' => 'nullable|image|max:1000',
    ];

    public function mount() { $this->category = auth()->user(); }

    public function save()
    {
        $this->validate();

        $this->category->save();

        $this->upload && $this->category->update([
            'avatar' => $this->upload->store('/', 'avatars'),
        ]);

        $this->emitSelf('notify-saved');
    }
}
