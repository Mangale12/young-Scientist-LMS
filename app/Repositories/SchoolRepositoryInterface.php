<?php

            namespace App\Repositories;
            use App\Http\Requests\SchoolRequest;
            interface SchoolRepositoryInterface
            {
                public function getAll();
                public function getById($id);
                public function create(SchoolRequest $request);
                public function update($id, SchoolRequest $request);
                public function delete($id);
            }
            