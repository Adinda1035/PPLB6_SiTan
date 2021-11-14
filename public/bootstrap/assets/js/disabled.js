
// let $available_values = JSON.parse('<?php echo json_encode($available); ?>');

available = available.map(String);

$(document).ready(function() {

    if( $.inArray( $(this).val(), available) === -1 ) {
        $('#panen_harian').prop( "disabled", true );
    }

    if ($(this).val() === "") {
        $('#tanggal_laporan').prop( "disabled", true );
        $('#jumlah_bebek_sakit').prop( "disabled", true );
        $('#jumlah_bebek_mati').prop( "disabled", true );
        $('#kondisi_kandang').prop( "disabled", true );
        $('#panen_harian').prop( "disabled", true );
    }

    $('#dropdown-no-kandang').change(function() {
        if ($(this).val() === "") {
            $('#tanggal_laporan').prop( "disabled", true );
            $('#jumlah_bebek_sakit').prop( "disabled", true );
            $('#jumlah_bebek_mati').prop( "disabled", true );
            $('#kondisi_kandang').prop( "disabled", true );
            $('#panen_harian').prop( "disabled", true );
        }
        else if( $.inArray( $(this).val().toString(), available) === -1) {
            $('#tanggal_laporan').prop( "disabled", false );
            $('#jumlah_bebek_sakit').prop( "disabled", false );
            $('#jumlah_bebek_mati').prop( "disabled", false );
            $('#kondisi_kandang').prop( "disabled", false );
            $('#panen_harian').prop( "disabled", true );
        }
        else {
            $('#tanggal_laporan').prop( "disabled", false );
            $('#jumlah_bebek_sakit').prop( "disabled", false );
            $('#jumlah_bebek_mati').prop( "disabled", false );
            $('#kondisi_kandang').prop( "disabled", false );
            $('#panen_harian').prop( "disabled", false );
        }
    });

});
