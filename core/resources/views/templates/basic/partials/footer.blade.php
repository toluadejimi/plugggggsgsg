@php
    $footerContent = getContent('footer.content', true);
    $policyPages = getContent('policy_pages.element', orderById: true);
    $socials = getContent('social_icon.element', orderById: true);
    $contact = getContent('contact_us.content', true);
@endphp
<footer class="footer-area">


{{--    <div class="col-12 my-4">--}}
{{--        @auth--}}

{{--            <div class="card-title mt-3 text-center">--}}
{{--                <h6 style="background: #565656; padding: 10px; border-radius: 10px; color: white"--}}
{{--                    class="text-left">RECENT ORDER</h6>--}}
{{--            </div>--}}


{{--            <div style="height:400px; width:100%; overflow-y: scroll;" class="card">--}}
{{--                <div class="card-body">--}}


{{--                    <div class="dashboard-body__item">--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table class="table style-two">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>Item</th>--}}
{{--                                    <th>Time</th>--}}

{{--                                </tr>--}}

{{--                                @if($bought_qty == 0)--}}
{{--                                @else--}}
{{--                                    @foreach($bought as $data)--}}

{{--                                        <tr>--}}
{{--                                            <td>{{\Illuminate\Support\Str::limit($data->user_name,4, '.')}}, <span style="color: #f10054">just purchase</span><br/> {{\Illuminate\Support\Str::limit($data->item,--}}
{{--                                    16, '...')}}<span style="color: #000000">₦{{number_format($data->amount)}}</span></td>--}}
{{--                                            <td>{{ diffForHumans($data->created_at) }}</td>--}}
{{--                                        </tr>--}}

{{--                                    @endforeach--}}
{{--                                @endif--}}



{{--                                </thead>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}





{{--                </div>--}}
{{--            </div>--}}
{{--        @else--}}

{{--        @endauth--}}

{{--    </div>--}}


{{--    <div class="bottom-footer py-3">--}}
{{--        <div class="container">--}}
{{--            <div class="row gy-3">--}}
{{--                <div class="col-sm-6">--}}
{{--                    <div class="bottom-footer__text"> &copy;  @php echo date('Y') @endphp . @lang('Loggsplug').</div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-6">--}}
{{--                    <div class="bottom-footer__menu d-flex align-items-end justify-content-end">--}}
{{--                        @foreach ($policyPages as $policy)--}}
{{--                            <a href="{{ route('policy.pages', [slug(@$policy->data_values->title), @$policy->id]) }}" class="bottom-footer__link">--}}
{{--                                {{ __(@$policy->data_values->title) }}--}}
{{--                            </a>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</footer>
