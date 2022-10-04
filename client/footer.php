<script src="main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    $('.skill-set').mouseover(function (e) {
        e.currentTarget.querySelector('.delete-btn').style.display = 'inline-block';
    });
    $('.skill-set').mouseout(function (e) {
        e.currentTarget.querySelector('.delete-btn').style.display = 'none';
    });
    
</script>
</body>

</html>