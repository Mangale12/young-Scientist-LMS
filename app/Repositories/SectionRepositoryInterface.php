<?php

            namespace App\Repositories;
            use App\Http\Requests\SectionRequest;
            interface SectionRepositoryInterface
            {
                public function getAll();
                public function getActiveSection();
                public function getById($id);
                public function create(SectionRequest $request);
                public function update($id, SectionRequest $request);
                public function delete($id);
            }
            