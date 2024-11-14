<?php

            namespace App\Repositories;
            use App\Http\Requests\SettingRequest;
            use App\Models\Setting;

            class SettingRepository extends DM_BaseRepository implements SettingRepositoryInterface
            {
                protected $folder_path_image;
                protected $folder_path_file;
                protected $folder = 'setting';
                protected $file   = 'file';
                protected $prefix_path_image = '/upload_file/setting/';
                protected $prefix_path_file = '/upload_file/setting/file/';
                public function __construct() {
                    $this->folder_path_image = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR;
                    $this->folder_path_file = getcwd() . DIRECTORY_SEPARATOR . 'upload_file' . DIRECTORY_SEPARATOR . $this->folder . DIRECTORY_SEPARATOR . $this->file . DIRECTORY_SEPARATOR;
                }
                public function getAll()
                {
                    return Setting::all();
                }

                public function getById($id)
                {
                    return Setting::first();
                }

                public function create(SettingRequest $request)
                {
                    return Setting::create($request);
                }

                public function update($id, SettingRequest $request)
                {
                    try {
                        //code...
                        $model = $this->getById($id);
                        $logo = $model->logo;
                        $favicon = $model->favicon;
                        if($request->has('logo')){

                            parent::deleteImage($logo);
                            $logo = parent::uploadImage($request->logo, $this->folder_path_image, $this->prefix_path_image);
                        }
                        if($request->has('favicon')){
                            parent::deleteImage($favicon);
                            $favicon = parent::uploadImage($request->favicon, $this->folder_path_image, $this->prefix_path_image);
                        }

                        $model->update([
                            'site_name'=>$request->site_name,
                            'site_contact'=>$request->site_contact,
                            'site_email' => $request->site_email,
                            'site_phone' => $request->site_phone,
                            'site_mobile' => $request->site_mobile,
                            'site_fax' => $request->site_fax,
                            'site_first_address' => $request->site_first_address,
                            'site_second_address' => $request->site_second_address,
                            'site_description' => $request->site_description,
                            'map' => $request->map,
                            'site_url' => $request->site_url,
                            'social_profile_fb' => $request->social_profile_fb,
                            'social_profile_twitter' => $request->social_profile_twitter,
                            'social_profile_instagram' => $request->social_profile_instagram,
                            'social_profile_linkedin' => $request->social_profile_linkedin,
                            'logo' => $logo,
                            'favicon' => $favicon,
                        ]);
                        return true;
                    } catch (\Throwable $th) {
                        dd($th);
                        return false;
                    }
                }

                public function delete($id)
                {
                    $model = $this->getById($id);
                    return $model->delete();
                }
            }
            