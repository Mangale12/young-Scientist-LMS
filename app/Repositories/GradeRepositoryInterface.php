<?php

            namespace App\Repositories;
            use App\Http\Requests\GradeRequest;
            interface GradeRepositoryInterface
            {
                public function getAll();
                public function getById($id);
                public function create(GradeRequest $data);
                public function update($id, GradeRequest $data);
                public function delete($id);
            }
            