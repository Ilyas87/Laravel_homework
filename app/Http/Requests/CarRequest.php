<?php

namespace App\Http\Requests;

use App\Models\Car;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class CarRequest extends FormRequest
{
    public function rules() {
        return [
            'name' => ['required', 'string', 'max:100'],
            'color' => ['nullable', 'string', 'max:100'],
            'year' => ['required', 'string', 'numeric', 'between:1900,' . date("Y")],
            'engine' => ['nullable', 'string', 'numeric', 'between:0,6.0'],
            'transmission' => ['nullable', 'string'],
            'mileage' => ['nullable', 'string', 'numeric', 'max:1000000'],
            'image' => ['nullable', 'file', 'image']
        ];
    }

    public function validatedWithImage() {
        $data = $this->validated();
//        $defaultImage = 'public/images/defaultImage.jpg';

        if ($this->hasFile('image')) {

            /** @var Car $car */
            if ($car = $this->route('cars')) {
                $car->deleteImage();
            }

            $data['image'] = $this->file('image')->store('public/images');
        }
//        else {
//            $data['image'] = $defaultImage;
//        }

        return $data;
    }
}
