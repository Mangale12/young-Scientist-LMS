<?php

            namespace App\Repositories;

            use App\Models\User;

            class UserRepository implements UserRepositoryInterface
            {
                public function getAll()
                {
                    return User::all();
                }

                public function getById($id)
                {
                    return User::findOrFail($id);
                }

                public function create(array $data)
                {
                    return User::create($data);
                }

                public function update($id, array $data)
                {
                    $model = User::findOrFail($id);
                    $model->update($data);
                    return $model;
                }

                public function delete($id)
                {
                    $model = User::findOrFail($id);
                    return $model->delete();
                }
            }
            