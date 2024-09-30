<aside>
    @php
        preg_match('/admin\/udhyog\/([^\/]*)/', request()->path(), $matches);
        $udhyogName = $matches[1] ?? '';
        if($udhyogName == 'aluchips') {
            $udhyogName = "alu chips";
        } elseif ($udhyogName == "hybridbiu") {
            $udhyogName = "hybrid biu";
        }

        $udhyogs = \App\Models\Udhyog::get();
        $voucherType = \App\Models\VoucherType::where('status', 1)->get();
    @endphp
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion" style="font-weight:bold;">
            @if(Route::has('admin.index'))
            <li>
                <a href="{{ URL::route('admin.index') }}" class="{{ ($_panel == 'Dashboard') ? 'active' : '' }}"><i class="fa fa-dashboard"></i><span>{{__('ड्याशबोर्ड')}}</span>
                </a>
            </li>
            @endif



            <li class="sub-menu">
                <a href="javascript:;" class="{{ ($_panel == 'Udhyog List' || $_panel == 'Ledger' || $_panel == 'Journal' || $_panel == 'Opening Balance' || $_panel == 'Partner Organization' || $_panel == 'Other Material' || $_panel == 'Finance Title' || $_panel == 'Damage Type' ||  $_panel == 'Fiscal' || $_panel == 'Udhyog List' || $_panel == 'Unit' || $_panel == 'Block' || $_panel == 'Ritu' || $_panel == 'Agriculture Category' || $_panel == 'Mal Bibran' || $_panel == 'Mesinary' || request()->is('admin/coa*')) ? 'active' : '' }}">
                    <i class="fa fa-gears"></i>
                    <span>मुख्य सेटअप</span>
                </a>
                <ul class="sub">
                    <li class="sub-menu">
                        <a href="javascript:;" class="{{ ($_panel == 'Ledger' || $_panel == 'Journal' || $_panel == 'Ledger' || $_panel == 'Opening Balance' || $_panel == 'Finance Title' || request()->is('admin/coa*')) ? 'active' : '' }}">
                            <i class="fa fa-users"></i>
                            <span>खाता/फाइनान्स</span>
                        </a>
                        <ul class="sub">
                            <li class="{{ $_panel == 'Voucher Type' ? 'active' : '' }}"><a href="{{ URL::route('admin.voucher_type.index') }}"><span> {{__('भौचर प्रकार')}}</span></a></li>
                            <li class="{{ $_panel == 'COA' ? 'active' : '' }}"><a href="{{ URL::route('admin.coa.index') }}"><span> {{__('खाता चार्ट')}}</span></a></li>
                            {{-- <li class="{{ $_panel == 'Opening Balance' ? 'active' : '' }}"><a href="{{ URL::route('admin.opening_balance.index') }}"><span> {{__('प्रारम्भिक ब्यालेन्स')}}</span></a></li> --}}
                            {{-- <li class="{{ $_panel == 'Ledger' ? 'active' : '' }}"><a href="{{ URL::route('admin.coa.ledger') }}"><span> {{ __('सामान्य खाता') }}</span></a></li> --}}
                        </ul>
                    </li>
                    <li class="{{ $_panel == 'Fiscal' ? 'active' : '' }}"><a href="{{ URL::route('admin.fiscal.index') }}"><span> {{ __('आर्थिक बर्ष सेटअप') }}</span></a></li>
                    <li class="{{ $_panel == 'Unit' ? 'active' : '' }}"><a href="{{ URL::route('admin.unit.index') }}"><span> {{ __('यूनिट/मापन सेटअप') }}</span></a></li>
                    <li class="{{ $_panel == 'Block' ? 'active' : '' }}"><a href="{{ URL::route('admin.block.index') }}"><span> {{ __('ब्लक सेटअप') }}</span></a></li>
                    <li class="{{ $_panel == 'Agriculture Category' || $_panel == 'Agriculture' ? 'active' : '' }}"><a href="{{ URL::route('admin.agriculture-category.index') }}"><span> {{ __('बालीनाली सेटअप') }}</span></a></li>
                    <li class="{{ $_panel == 'Anudaan Category' ? 'active' : '' }}"><a href="{{ URL::route('admin.anudaan-category.index') }}"><span> {{ __('अनुदान सेटअप') }}</span></a></li>
                    <li class="{{ $_panel == 'Mal Bibran' ? 'active' : '' }}"><a href="{{ URL::route('admin.mal-bibran.index') }}"><span> {{ __('मल बिबरण सेटअप') }}</span></a></li>
                    <li class="{{ $_panel == 'Mesinary' ? 'active' : '' }}"><a href="{{ URL::route('admin.mesinary.index') }}"><span> {{ __('मेसिनरी तथा औजार सेटअप') }}</span></a></li>
                    <li class="{{ $_panel == 'Damage Type' ? 'active' : '' }}"><a href="{{ URL::route('admin.inventory.damage_types.index') }}"><span> {{__('क्षतिको प्रकार')}}</span></a></li>
                    <li class="{{ $_panel == 'Other Material' ? 'active' : '' }}"><a href="{{ URL::route('admin.other_material.index') }}"><span> {{__('अन्य सामग्री')}}</span></a></li>
                    <li class="{{ $_panel == 'Partner Organization' ? 'active' : '' }}"><a href="{{ URL::route('admin.partener_organization.index') }}"><span> {{__('साझेदार संस्थाहरु')}}</span></a></li>
                    <li class="{{ ($_panel == 'Udhyog List') ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog_setup.index') }}"><span> {{ __('उद्योग सेट अप ') }}</span></a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" class="{{ ($_panel == 'Users' || $_panel == 'Role' || $_panel == 'Permission')   ? 'active' : '' }}">
                    <i class="fa fa-users"></i>
                    <span>कार्यालय प्रयोगकर्ता रोल</span>
                </a>
                <ul class="sub">
                    @if(Route::has('admin.users.index'))
                    <li class="{{ ($_panel == 'Users') ? 'active' : '' }}"><a href="{{ URL::route('admin.users.index') }}"><span> {{ __('कार्यालय प्रयोगकर्ता हरु') }}</span></a></li>
                    @endif

                    @if(Route::has('admin.roles.index'))
                    <li class="{{ ($_panel == 'Role') ? 'active' : '' }}"><a href="{{ URL::route('admin.roles.index') }}"><span> {{ __('भूमिका') }}</span></a></li>
                    @endif
                    {{-- @if(Route::has('admin.permissions.index'))
                    <li class="{{ ($_panel == 'Permission') ? 'active' : '' }}"><a href="{{ URL::route('admin.permissions.index') }}"><span> {{ __('अनुमति') }}</span></a></li>
                    @endif --}}
                    {{-- <li><a class="" href="#"></span></a></li> --}}
                </ul>
            </li>

            <li class="sub-menu">
                    <a href="javascript:;" class=" {{ request()->is('admin/udhyog*') ? 'active' : '' }}">
                    <i class="fa fa-shopping-cart"></i>
                    <span>उद्योगहरु </span>
                </a>
                <ul class="sub">
                    @foreach ($udhyogs as $udhyog)
                    <li>
                        <a href="#" class="{{ (!empty($data['udhyog']->key) ? ($data['udhyog']->key == $udhyog->key ? 'active' : '') : '') }}{{ (!empty($key) ? ($key == $udhyog->key ? 'active' : '') : '') }}"><span>{{__($udhyog->name)}}</span></a>
                        <ul class="sub">
                            <li class="sub-menu">
                                <a href="javascript:;" class="{{ request()->is('admin/udhyog/'.$udhyog->key.'/inventory*') ? 'active' : '' }}">
                                    <i class="fa fa-money"></i>
                                    <span>इन्भेन्टरी सेटअप</span>
                                </a>
                                <ul class="sub">
                                    <li class="{{ request()->is('admin/udhyog/'.$udhyog->key.'/inventory/suppliers*') ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.inventory.suppliers.index',['key'=>$udhyog->key]) }}"><span> {{__('सप्लायर्स')}}</span></a></li>
                                    @if($udhyog->is_agricultural == 0)
                                    <li class="{{ (request()->is('admin/udhyog/'.$udhyog->key.'/inventory/raw-material-name*') || request()->is('admin/udhyog/'.$udhyog->key.'/inventory/raw-material*')) ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.inventory.raw_material_name.index', ['key'=>$udhyog->key]) }}"><span> {{__('कच्चा पद्दार्थ')}}</span></a></li>
                                    @endif
                                    <li class="{{ (request()->is('admin/udhyog/'.$udhyog->key.'/inventory/products*')) ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.inventory.products.index', ['key'=>$udhyog->key]) }}"><span> {{__('उत्पादन')}}</span></a></li>
                                    @if($udhyog->is_agricultural == 0)
                                    <li class="{{ (request()->is('admin/udhyog/'.$udhyog->key.'/inventory/production-batch*')) ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.inventory.production_batch.index', ['key'=>$udhyog->key]) }}"><span> {{__('उत्पादन ब्याच')}}</span></a></li>
                                    @endif
                                    <li class="{{ (request()->is('admin/udhyog/'.$udhyog->key.'/inventory/dealers*')) ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.inventory.dealers.index', ['key'=>$udhyog->key]) }}"><span> {{__('डिलर/व्यक्ति')}}</span></a></li>
                                    <li class="{{ (request()->is('admin/udhyog/'.$udhyog->key.'/inventory/sales_orders*')) ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.inventory.sales_orders.index', ['key'=>$udhyog->key]) }}"><span> {{__('बिक्री/बिक्री आदेश')}}</span></a></li>
                                    <li class=""><a href="{{ URL::route('admin.udhyog.inventory.products.inventory', ['key'=>$udhyog->key]) }}"><span> {{__('इन्भेन्टरी')}}</span></a></li>
                                    @if($udhyog->is_agricultural == 0)
                                    <li class="{{ (request()->is('admin/udhyog/'.$udhyog->key.'/inventory/damage-records*')) ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.inventory.damage_records.index', ['key'=>$udhyog->key]) }}"><span> {{__('क्षति अभिलेख')}}</span></a></li>
                                    @endif
                                    @if($udhyog->is_agricultural == 0)
                                    <li class="{{ (request()->is('admin/udhyog/'.$udhyog->key.'/inventory/raw-materials/low-stock') || request()->is('admin/udhyog/'.$udhyog->key.'/inventory/products/low-stock')) ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.inventory.products.low_stock', ['key'=>$udhyog->key]) }}"><span> {{__('कम स्टक')}}</span></a></li>
                                    <li class="{{ (request()->is('admin/udhyog/'.$udhyog->key.'/inventory/production-batch/expiring-products')) ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.inventory.production_batch.view_alert', ['key'=>$udhyog->key]) }}"><span> {{__('चेतावनी उत्पादन')}}</span></a></li>
                                    <li class="{{ (request()->is('admin/udhyog/'.$udhyog->key.'/inventory/products/expired_products')) ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.inventory.products.expired_products', ['key'=>$udhyog->key]) }}"><span> {{__('म्याद सकिएको उत्पादन')}}</span></a></li>
                                    @endif
                                    @if($udhyog->is_agricultural == 1)
                                    <li class="{{ (request()->is('admin/udhyog/'.$udhyog->key.'/inventory/seed-types*')) ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.inventory.seed_types.index', ['key'=>$udhyog->key]) }}"><span> {{__('बिउको प्रकार ')}}</span></a></li>
                                    <li class="{{ (request()->is('admin/udhyog/'.$udhyog->key.'/inventory/seed-jaat*')) ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.inventory.seed_jaat.index', ['key'=>$udhyog->key]) }}"><span> {{__('बिउको जात ')}}</span></a></li>
                                    <li class="{{ (request()->is('admin/udhyog/'.$udhyog->key.'/inventory/seeds*')) ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.inventory.seeds.index', ['key'=>$udhyog->key]) }}"><span> {{__('बिउ')}}</span></a></li>
                                    <li class="{{ (request()->is('admin/udhyog/'.$udhyog->key.'/inventory/seasons*')) ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.inventory.seasons.index', ['key'=>$udhyog->key]) }}"><span> {{__('सिजन')}}</span></a></li>
                                    <li class="{{ (request()->is('admin/udhyog/'.$udhyog->key.'/inventory/seed-batch*')) ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.inventory.seed_batch.index', ['key'=>$udhyog->key]) }}"><span> {{__('बीज उत्पादन ब्याच')}}</span></a></li>
                                    <li class=""><a href="{{ URL::route('admin.udhyog.inventory.products.index', ['key'=>$udhyog->key]) }}"><span> {{__('उत्पादन')}}</span></a></li>
                                    <li class="{{ (request()->is('admin/udhyog/'.$udhyog->key.'/inventory/khadhyanna*')) ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.inventory.khadhyanna.index', ['key'=>$udhyog->key]) }}"><span> {{__('खाद्यान्न')}}</span></a></li>
                                    @endif
                                </ul>
                            </li>
                            <li class="sub-menu">
                                <a href="javascript:;" class="{{ (request()->is('admin/udhyog/'.$udhyog->key.'/fianance/*') || request()->is('admin/udhyog/'.$udhyog->key.'opening-balances*') || request()->is('admin/udhyog/'.$udhyog->key.'/journals*') || request()->is('admin/udhyog/'.$udhyog->key.'/ledger*') || request()->is('admin/udhyog/'.$udhyog->key.'/edit-voucher*') || request()->is('admin/udhyog/'.$udhyog->key.'/coa*') ? 'active' : '') ? 'active' : '' }}">
                                    <i class="fa fa-money"></i>
                                    <span>फाइनान्स/लेखा शीर्षक</span>
                                </a>
                                <ul class="sub">
                                    <li class="{{ $_panel == 'COA' ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.coa.index', ['key'=>$udhyog->key]) }}"><span> {{__('खाता चार्ट')}}</span></a></li>
                                    <li class="{{ (request()->is('admin/udhyog/'.$udhyog->key.'/fianance/create')) ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.fianance.create', ['key'=>$udhyog->key]) }}"><span>{{__('जर्नल प्रविष्टि')}}</span></a></li>
                                    <li class="{{ request()->is('admin/udhyog/'.$udhyog->key.'/fianance/profit-loss*') ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.fianance.profit_loss', ['key'=>$udhyog->key]) }}"><span> {{__('खर्च/आय')}}</span></a></li>
                                    <li class="{{ (request()->is('admin/udhyog/'.$udhyog->key.'/fianance/balancesheet*')) ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.fianance.balance_sheet', ['key'=>$udhyog->key]) }}"><span> {{__('ब्यालेन्स पाना')}}</span></a></li>
                                    {{-- <li class="{{ (request()->is('admin/udhyog/'.$udhyog->key.'/fianance/*')) ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.fianance.index', ['key'=>$udhyog->key]) }}"><span>{{__('भौचर')}}</span></a></li> --}}
                                    <li class="{{ $_panel == 'Opening Balance' ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.opening_balance.index',['key'=>$udhyog->key]) }}"><span> {{__('प्रारम्भिक ब्यालेन्स')}}</span></a></li>
                                    {{-- <li class="{{ $_panel == 'Journal' ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.journal', ['key'=>$udhyog->key]) }}"><span> {{ __('जर्नल खाता') }}</span></a></li> --}}
                                    <li class="{{ $_panel == 'Ledger' ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.ledger', ['key'=>$udhyog->key]) }}"><span> {{ __('सामान्य खाता') }}</span></a></li>
                                    <li class="{{ $_panel == 'Day Book' ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.day_book', ['key'=>$udhyog->key]) }}"><span> {{ __('दिन पुस्तक') }}</span></a></li>
                                    <li class="{{ request()->is('admin/udhyog/'.$udhyog->key.'/edit-voucher*') ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.voucher-edit', ['key'=>$udhyog->key]) }}"><span> {{ __('हेर्नु / सम्पादन गर्नु') }}</span></a></li>
                                    <li class="{{ request()->is('admin/udhyog/'.$udhyog->key.'/edit-voucher*') ? 'active' : '' }}"><a href="{{ URL::route('admin.udhyog.set-up-new-fiscal-year', ['key'=>$udhyog->key]) }}"><span> {{ __('नयाँ आर्थिक वर्ष सेटअप') }}</span></a></li>
                                </ul>
                            </li>

                            <li class=""><a href="{{ URL::route('admin.udhyog.worker-types.index', ['key'=>$udhyog->key]) }}"><span>{{__('कामदार')}}</span></a></li>
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </li>


            <li class="sub-menu">
                <a href="javascript:;" class="{{ ($_panel == 'Training Person' || $_panel == 'Datri Nikai' ||$_panel == 'Anudaan' ||$_panel == 'Talim' ||$_panel == 'Beema' || request()->is('admin/programs*') ) ? 'active' : '' }}">
                    <i class="fa fa-tasks"></i>
                    <span>अनुदान तथा तालिम</span>
                </a>
                <ul class="sub">
                    <li class="{{ ($_panel == 'Anudaan') ? 'active' : '' }}"><a href="{{ URL::route('admin.anudaan.index') }}"><span> {{ __('अनुदान') }}</span></a></li>
                    <li class="{{ ($_panel == 'Talim') ? 'active' : '' }}"><a href="{{ URL::route('admin.talim.index') }}"><span> {{ __('तालिम सेटअप') }}</span></a></li>
                    <li class="{{ ($_panel == 'Training Person') ? 'active' : '' }}"><a href="{{ URL::route('admin.training_person.index') }}"><span> {{ __('व्यक्तिको सूची') }}</span></a></li>
                    <li class="{{ ($_panel == 'Program') ? 'active' : '' }}"><a href="{{ URL::route('admin.programs.index') }}"><span> {{ __('कार्यक्रम') }}</span></a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="fa fa-cloud-upload"></i>
                    <span>फार्म</span>
                </a>
                <ul class="sub">
                    <li><a href="{{ URL::route('admin.farms.index') }}" class="{{ ($_panel == '') ? 'active' : '' }}"><span>{{__('फार्म')}}</span></a></li>
                    <li><a href="{{ URL::route('admin.farm_amdani.index') }}" class="{{ ($_panel == '') ? 'active' : '' }}"><span>{{__('फारम आम्दानी ')}}</span></a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" class="{{ request()->is('admin/setting*') ? 'active' : '' }}">
                    <i class="fa fa-cloud-upload"></i>
                    <span>सेटिङ्हरू</span>
                </a>
                <ul class="sub">
                    <li class="{{ request()->is('admin/setting') ? 'active' : '' }}"><a href="{{ route('admin.setting.index') }}" ><span>{{__('सामान्य सेटिङ')}}</span></a></li>
                    <li class="{{ request()->is('admin/setting/social') ? 'active' : '' }}"><a href="{{ route('admin.setting.social.index') }}" class="{{ ($_panel == '') ? 'active' : '' }}"><span>{{__('सोसियल लिंकहरु')}}</span></a></li>
                    <li><a href="#" class="{{ ($_panel == '') ? 'active' : '' }}"><span>{{__('लग')}}</span></a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" class=" {{ ($_panel == 'Profile Report' || $_panel == 'Farm Report'  || $_panel == 'Anudaan Report' || $_panel == 'Talim Report' || $_panel == 'Datrinikai Report' || $_panel == 'Beema Report' || $_panel == 'Sangrachana Report' || $_panel == 'Mesinary Report' || $_panel == 'Biu Bijan Report' || $_panel == 'Animal Report' || $_panel == 'Agriculture Report') ? 'active' : '' }}">
                    <i class="fa fa-gears"></i>
                    <span>रिपोर्ट</span>
                </a>
                <ul class="sub">
                    <li class="{{ ($_panel == 'Profile Report') ? 'active' : '' }}"><a href="{{ URL::route('admin.report.purchase') }}"><span> {{ __('खरिद रिपोर्ट ') }}</span></a></li>
                    <li class="{{ ($_panel == 'Farm Report') ? 'active' : '' }}"><a href="{{ URL::route('admin.report.sales') }}"><span> {{ __('बिक्री बिबरण रिपोर्ट ') }}</span></a></li>
                    <li class="{{ ($_panel == 'Profit Loss') ? 'active' : '' }}"><a href="{{ URL::route('admin.report.profit_loss') }}"><span> {{ __('नाफा/घाटा') }}</span></a></li>

                </ul>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
