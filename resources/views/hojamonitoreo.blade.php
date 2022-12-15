<div class="mainpdf">

    <div class="pdfhead">
        <div class="pdftitle">
            <div style="margin-bottom: 5px;">DIRECCION DE AREA DE SALUD DE TOTONICAPAN</div>
            <div>Monitoreo y Supervision del Programa de Seguridad Alimentaria y Nutricional</div>
        </div>
        <div class="pdfdetalles">
            <div style="margin-bottom: 10px">
                Fecha: {{ $hojaMonitoreo->fecha  }}
            </div>
            <div style="margin-bottom: 10px">
                Centro de Salud: {{ $hojaMonitoreo->cs  }}
            </div>
            <div style="margin-bottom: 10px">
                Puesto de Salud: {{ $hojaMonitoreo->ps  }}
            </div>
            <table>
                <tr>
                    <td>Municipio: {{ $hojaMonitoreo->municipio  }}</td>
                    <td>Territorio: {{ $hojaMonitoreo->territorio  }}</td>
                </tr>
                <tr>
                    <td>Personal Supervisado: {{ $hojaMonitoreo->personal_supervisado  }}</td>
                    <td>Cargo: {{ $hojaMonitoreo->cargo  }}</td>
                </tr>
            </table>
            <div style="width: 50%; margin-top: 60px; margin-bottom: 40px">
                <table>
                  <tr>
                      <td>Supervisor: {{ $hojaMonitoreo->supervisor  }}</td>
                      <td class="campo">Firma:</td>
                  </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="pdfbody">
        <div>
            <h4>Insumos del programa de nutricion</h4>
        </div>
        <table class="table_insumos">
            <thead>
                <tr>
                    <th>Abastecimiento del servicio</th>
                    <th>si/no</th>
                    <th>Saldo en Kardex</th>
                    <th>Entrada</th>
                    <th>Fecha Vencimiento</th>
                    <th>Lote</th>
                    <th>MED</th>
                    <th>No de Kardex</th>
                    <th>DR segun sigsa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hojaMonitoreo->insumos as $insumo)
                    <tr>
                        <td>{{ $insumo->nombre  }}</td>
                        <td>{{ $insumo->activo  }}</td>
                        <td>{{ $insumo->saldo_kardex  }}</td>
                        <td>{{ $insumo->entrada  }}</td>
                        <td>{{ $insumo->fecha_vencimiento  }}</td>
                        <td>{{ $insumo->lote  }}</td>
                        <td>{{ $insumo->med  }}</td>
                        <td>{{ $insumo->no_kardex  }}</td>
                        <td>{{ $insumo->DR  }}</td>
                    </tr>
                    <tr>
                        <td colspan="9"> Observaciones: {{  $insumo->observaciones  }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            Observaciones generales: {{ $hojaMonitoreo->observaciones }}
        </div>
        <div class="campo" style="width: 50%; margin-top: 100px; margin-bottom: 40px">
            Firma y Sello:
        </div>
    </div>

</div>


<style type="text/css" media="screen">


 .campo{
     border-bottom: 2px solid black;
 }
 .table_insumos{
     font-size: 12px;
     background-color: gray;
     padding: 4px;
     border-radius: 5px;
     margin-bottom: 15px;
 }

 .table_insumos tr{
     background-color: white;
 }

 table{
     width: 100%;
 }
 td{
     width: 50%;
 }

 .pdftitle{
     text-align: center;
     font-weight: 800;
 }

 .pdfdetalles{
     margin-top: 20px;
 }
 .pdfdetalles div{
     margin-top: 5px;
 }
</style>
