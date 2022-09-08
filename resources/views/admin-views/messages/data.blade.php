@php($array=[])
@foreach($conversations as $conv)
{{-- {{ dd($conv) }} --}}
    @if(in_array($conv->sender_id,$array)==false)
        @php(array_push($array,$conv->sender_id))
        @php($user=\App\Models\UserInfo::find($conv->sender_id))
        @php($last_sender=$conv->sender_id)
        {{-- @php($unchecked=\App\Models\Message::where(['conversation_id'=>$conv->id, 'is_seen' => 0])->count()) --}}
        @php($unchecked=($conv->last_message->sender_id != $last_sender)?0:$conv->unread_message_count)
        @if ($user)
            <div
                class="chat-user-info d-flex border-bottom p-3 align-items-center customer-list {{$unchecked!=0?'conv-active':''}}"
                onclick="viewConvs('{{route('admin.message.view',['conversation_id'=>$conv->id,'user_id'=>$conv->sender_id])}}','customer-{{$conv->sender_id}}','{{ $conv->id }}','{{ $conv->sender_id }}')"
                id="customer-{{$conv->sender_id}}">
                <div class="chat-user-info-img d-none d-md-block">
                    <img class="avatar-img"
                            src="{{asset('storage/app/profile/'.$user['image'])}}"
                            onerror="this.src='{{asset('assets/admin')}}/img/160x160/img1.jpg'"
                            alt="Image Description">
                </div>
                <div class="chat-user-info-content">
                    <h5 class="mb-0 d-flex justify-content-between">
                        <span class=" mr-3">{{$user['f_name'].' '.$user['l_name']}}</span> <span
                            class="{{$unchecked!=0?'badge badge-info':''}}">{{$unchecked!=0?$unchecked:''}}</span>
                    </h5>
                    <span>{{ $user['phone'] }}</span>
                </div>
            </div>
        @else
            <div
                class="chat-user-info d-flex border-bottom p-3 align-items-center customer-list">
                <div class="chat-user-info-img d-none d-md-block">
                    <img class="avatar-img"
                            src='{{asset('assets/admin')}}/img/160x160/img1.jpg'
                            alt="Image Description">
                </div>
                <div class="chat-user-info-content">
                    <h5 class="mb-0 d-flex justify-content-between">
                        <span class=" mr-3">{{translate('messages.user_not_found')}}</span>
                    </h5>
                </div>
            </div>
        @endif
    @endif
@endforeach
