<style>
.curtain {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 128, 255, 0.9);
    z-index: 9999;
    transition: transform 2s ease-out;
    transform: translateY(0);
}
</style>
<script>
    document.addEventListener('DOMContentLoaded', () => {
    const curtain = document.querySelector('.curtain');
    setTimeout(() => {
        curtain.style.transform = 'translateY(-100%)';
        document.body.style.overflow = 'auto';
    }, 100);
});

</script>
<body>
    <div class="curtain"></div>
</body>
