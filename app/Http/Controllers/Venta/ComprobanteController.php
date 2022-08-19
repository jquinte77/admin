<?php

namespace App\Http\Controllers\Venta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TipVar;
use Illuminate\Support\Facades\DB;

class ComprobanteController extends Controller
{
    private $tipVar;
    private $tipodoc;

    public function __construct()
    {
        $this->tipVar = TipVar::whereIn('vparent',['conDoc','TipEstDoc'])->get();
    }
    public function facturaVista($id){

        return view('venta.comprobante',[
            'tipodoc' => $id,
            'arrCbo' => $this->tipVar,
        ]);
    }

    public function listarFactura(Request $request){

        $doc            = $request->get('doc');
        $fechaInicio    = $request->get('fechaInicio');
        $fechaFin       = $request->get('fechaFin');

        // return ['doc'=>$doc,'fechaInicio'=>$fechaInicio,'fechaFin'=>$fechaFin];

        $response = DB::select("SELECT vcoddv, b.vDescri Estado, a.vclient, a.vdocide, a.vserie,RIGHT(a.vnumdoc,8) AS 'nro', c.vdescri  Condicion, a.sdfecdoc, d.vdescri Moneda, a.siTipIgv, a.sitipmon, a.sitipigv,
        a.nGravado, a.nExoner, a.nValigv, a.nSaldos, a.nTotal
        FROM dvgeneral a
        LEFT JOIN sgtipvar b ON b.vparent='TipEstDoc' AND b.vcodalt=a.sitipest
        LEFT JOIN sgtipvar c ON c.vparent='ConDoc' AND c.vcodalt=a.sitipcon
        LEFT JOIN sgtipvar d ON d.vparent='TipMon' AND d.vcodalt=a.sitipmon WHERE (sdfecdoc BETWEEN '{$fechaInicio}' AND '{$fechaFin}' AND vtipdoc = {$doc} )");

        return response()->json($response);
    }

    public function detalleFactura(Request $request){
        $id = $request->get('id');
        $response = DB::select("SELECT a.icodart, a.icodund, ar.ctipart, a.iitems, ar.vcodalt, ar.vdescri, a.ncantid, u.vdescri, a.nprecio, a.nsubtot, ei.vrefere, ei.vobserv
        FROM dvitem a
        LEFT JOIN ardetart ar ON ar.icodart=a.icodart
        LEFT JOIN sgunidad u ON u.icodund=a.icodund
        LEFT JOIN extraitem ei ON ei.icoddoc=a.vcoddv AND ei.siitem=a.iitems
        WHERE a.vcoddv = ? ",[$id]);

        return response()->json($response);
    }
}
