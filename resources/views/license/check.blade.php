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
           <form @submit.prevent="checkLicense">
            <div style="margin-top:10px;">
            License Key: <input type="text" v-model="license_key" placeholder="license_key"><br>
            </div>
            <div style="margin-top:10px;">
             <input type="submit" value="Check License">
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
        license_key: ''
      },
      methods: {
        checkLicense(){
            axios.post('/check/license',{
               client_id:this.user.id,
               license_key: this.license_key
            })
            .then((response)=>{
                if(response.data.error){
                    $('#error').html(response.data.error).css('color','red');
                }
                this.license_key = '';
                $('#success').html(response.data.success).css('color','green');
            })
            .catch((error)=>{
                console.log('Error.....');
            })
        }
      }
    })
  </script>
@endpush
