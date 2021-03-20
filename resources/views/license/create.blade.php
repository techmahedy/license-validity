@extends('welcome')
@push('css')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endpush
@section('content')
   <div id="app">
       <div class="client-d">
           <span id="error"></span>
           <span id="success"></span>
           <form @submit.prevent="saveLicense">
            Clinet ID: <input type="text" v-model="user_id" placeholder="Client ID"><br>
            <div style="margin-top:10px;">
            License Key: <input type="text" v-model="license_key" placeholder="license_key" id="license_key"><br>
            </div>
            <div style="margin-top:10px;">
            License For: 
            <select v-model="expire_date">
                <option value="3">3 Month</option>
                <option value="6">6 Month</option>
                <option value="12">12 Month</option>
            </select><br>
            </div>
            <div style="margin-top:10px;">
             <input type="submit" value="Save"> | <button @click.prevent="generateKey">Create Key</button>
            </div>
           </form>
       </div>
   </div>
@endsection
@push('script')
  <script>
    const app = new Vue({
      el: '#app',
      data: {
        user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!},
        expire_date: '',
        user_id: '',
        license_key: ''
      },
      methods: {
        generateKey(){
            let key = this.createUniqueKey(20);
            this.license_key = key;
            $('#license_key').val(key);
        },
        createUniqueKey(length) {
            let result = '';
            let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let charactersLength = characters.length;
            for ( let i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        },
        saveLicense(){
            axios.post('/license',{
               client_id:this.user.id,
               license_key: this.license_key,
               expire_date: this.expire_date
            })
            .then((response)=>{
                if(response.data.error){
                    $('#error').html(response.data.error).css('color','red');
                }
                this.user_id = '';
                this.license_key = '';
                this.expire_date = '';
                
                $('#success').html(response.data);
            })
            .catch((error)=>{
                console.log('Error.....');
            })
        }
      }
    })
  </script>
@endpush
