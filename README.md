kebutuhan intall untuk payment getway :

composer require midtrans/midtrans-php

// UNTUK FRONTEND

User bayar pakai Snap:

snap.pay(snap_token, {
onSuccess: function(result){
console.log('paid');
},
onPending: function(result){
console.log('pending');
},
onError: function(result){
console.log('error');
}
});
