<div class="mainpdf">

    <div class="pdfhead">
        <div class="pdftitle">
            <div style="margin-bottom: 5px;">DIRECCION DE AREA DE SALUD DE TOTONICAPAN</div>
            <div>Monitoreo y Supervision del Programa de Seguridad Alimentaria y Nutricional</div>
        </div>
        <div class="pdfdetalles">
            <div style="margin-bottom: 10px">
                Fecha Analisis: {{ $minutum->fecha_analisis  }}
            </div>
            <div style="margin-bottom: 10px">
                Distrito: {{ $minutum->distrito  }}
            </div>
            <div style="margin-bottom: 10px">
                Responsable: {{ $minutum->responsable  }}
            </div>
            <table>
                <tr>
                    <td>Fecha Inicio: {{ $minutum->fecha_inicio  }}</td>
                    <td>Fecha Final: {{ $minutum->fecha_final  }}</td>
                </tr>
            </table>
            <div style="width: 50%; margin-top: 60px; margin-bottom: 40px">
                <table>
                  <tr>
                      <td>Supervisor: {{ $minutum->supervisor  }}</td>
                      <td class="campo">Firma:</td>
                  </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="pdfbody">
        <div>
            <h4>Problemas a solucionar de la hoja de minuta.</h4>
        </div>
        <table class="table_insumos">
            <thead>
                <tr>
                    <th>Descripcion</th>
                    <th>Responsable</th>
                    <th>Causas</th>
                    <th>Acciones</th>
                    <th>Recursos</th>
                    <th>Fecha Aplicacion</th>
                    <th>Logros</th>
                </tr>
            </thead>
            <tbody>
                @foreach($minutum->problemas as $problema)
                    <tr>
                        <td>{{ $problema->descripcion  }}</td>
                        <td>{{ $problema->responsable  }}</td>
                        <td>{{ $problema->causas }}</td>
                        <td>{{ $problema->acciones  }}</td>
                        <td>{{ $problema->recursos  }}</td>
                        <td>{{ $problema->fecha_aplicacion  }}</td>
                        <td>{{ $problema->logros  }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            Observaciones generales: {{ $minutum->observaciones }}
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
