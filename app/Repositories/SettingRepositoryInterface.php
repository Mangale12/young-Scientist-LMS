<?php

            namespace App\Repositories;
            use App\Http\Requests\SettingRequest;
            interface SettingRepositoryInterface
            {
                public function getAll();
                public function getById($id);
                public function create(SettingRequest $request);
                public function update($id, SettingRequest $request);
                public function delete($id);
            }
            