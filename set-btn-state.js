var State = localStorage.getItem('btnState');
// console.log(State);
if (State == 1) {
    document.getElementById('switch-btn').setAttribute('checked', true);
}