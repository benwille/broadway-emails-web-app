var posts = [];

$( 'input[type=number' ).each( function() {
  if ( 0 == $( this )[0].value ) {
    $( this )[0].value = '';
  }
});

$( 'input, select' ).change( function() {
  var visible, row, str, msg, params, id, station;
  if ( 'post[visible]' === $( this ).attr( 'name' ) && false === $( this ).prop( 'checked' ) ) {
    visible = 0;
  } else {
    visible = 1;
  }
  row = $( this ).parentsUntil( 'tbody' );

  str = row.find( 'form' ).attr( 'action' );
  msg = str.split( '=' );
  params = msg[1].split( '&' );
  id = params[0];
  station = msg[2];
  var post = {
    id: id,
    station: station,
    category: row.find( 'select' ).val(),
    position: row.find( 'input[name="post[position]"]' ).val(),
    featured: row.find( 'input[name="post[featured]"][type="checkbox"]:checked' ).val() ? 1 : 0,
    visible: visible
  };

  posts.push( post );
  // console.log( posts );
});

$( 'input[type=submit]' ).click( function( e ) {
  e.preventDefault();

  $.post( 'ajax.php', {
      posts: posts
    }, function() {

      location.reload();
    });
});
