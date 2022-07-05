
document.querySelector('.ivan-btn-information').onclick = function(e){
    e.preventDefault();
    document.querySelector('.ivan-btn-active').classList.remove('ivan-btn-active');
    document.querySelector('.ivan-btn-information').classList.add('ivan-btn-active');
    document.querySelector('.ivan-visible').classList.remove('ivan-visible');
    document.querySelector('.ivan-information').classList.add('ivan-visible');
}
document.querySelector('.ivan-btn-structure').onclick = function(e){
    e.preventDefault();
    document.querySelector('.ivan-btn-active').classList.remove('ivan-btn-active');
    document.querySelector('.ivan-btn-structure').classList.add('ivan-btn-active');
    document.querySelector('.ivan-visible').classList.remove('ivan-visible');
    document.querySelector('.ivan-structure').classList.add('ivan-visible');
}
document.querySelector('.ivan-btn-programs').onclick = function(e){
    e.preventDefault();
    document.querySelector('.ivan-btn-active').classList.remove('ivan-btn-active');
    document.querySelector('.ivan-btn-programs').classList.add('ivan-btn-active');
    document.querySelector('.ivan-visible').classList.remove('ivan-visible');
    document.querySelector('.ivan-programs').classList.add('ivan-visible');
}
document.querySelector('.ivan-btn-dean').onclick = function(e){
    e.preventDefault();
    document.querySelector('.ivan-btn-active').classList.remove('ivan-btn-active');
    document.querySelector('.ivan-btn-dean').classList.add('ivan-btn-active');
    document.querySelector('.ivan-visible').classList.remove('ivan-visible');
    document.querySelector('.ivan-dean').classList.add('ivan-visible');
}