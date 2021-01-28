<?php

namespace App\Http\Controllers;

use Afip;
use App\FacturacionElectronicaCertificado;
use App\Prestador;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FacturacionElectronicaCertificadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser = Auth::user();
        $data = array();
		$prestador = Prestador::where('user_id', $authUser->id)->pluck('id');
        $certificados = FacturacionElectronicaCertificado::where('user_id', $authUser->id)->first();
        $data['certs_info'] = $certificados;

        // Objeto Menu prestador
        $prestador_menu = DB::select("SELECT obrasocial.nombre, obrasocial.id FROM obrasocial LEFT JOIN prestador on prestador.os_id = obrasocial.id WHERE prestador.user_id = " . $authUser->id . " GROUP BY obrasocial.id, obrasocial.nombre");
        $data['prestador_menu'] = $prestador_menu;

		if(!isset($certificados->cert_path) || !isset($certificados->key_path)){
            $data['certs'] = false;
        }else{
            try {
                $afip = new Afip(array(
                                        'CUIT' => 20389531376,
                                        'cert' => $certificados->cert_path,
                                        'key' => $certificados->key_path,
                                        'res_folder' => storage_path('app/'),
                                        'ta_folder' => storage_path('/app/csr/'.$authUser->id.'/'),
                                    ));
                                    // dd($afip);
                $data['fe_info'] = array();
                $data['fe_info']['voucher_types'] = $afip->ElectronicBilling->GetVoucherTypes();
                $data['fe_info']['concept_types'] = $afip->ElectronicBilling->GetConceptTypes();
                $data['fe_info']['document_types'] = $afip->ElectronicBilling->GetDocumentTypes();
                $data['fe_info']['aliquote_types'] = $afip->ElectronicBilling->GetAliquotTypes();
                $data['fe_info']['currency_types'] = $afip->ElectronicBilling->GetCurrenciesTypes();
                $data['fe_info']['option_types'] = $afip->ElectronicBilling->GetOptionsTypes();
                $data['fe_info']['tax_types'] = $afip->ElectronicBilling->GetTaxTypes();
                $data['certs'] = true;
            } catch (Exception $e) {
                $data['certs'] = false;
                $data['error'] = 'Un error ha ocurrido obteniendo los datos de AFIP. Por favor verifique los certificados e intente nuevamente. '.$e->getMessage();
                return view('facturacion-electronica.carga-certificados-inicial', $data);
            }
        }
        return view('facturacion-electronica.carga-certificados-inicial', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $authUser = Auth::user();
        $validation = Validator::make($request->all(), [
            'certificado' => 'required'
        ]);

        if($validation->fails()){
            return redirect()->back()->with('error', 'El certificado no es correcto. Por favor cargarlo nuevamente');
        }

        $certificado = FacturacionElectronicaCertificado::where('user_id', $authUser->id)->first();
        if(!$certificado){
            $certificado = new FacturacionElectronicaCertificado();
            $certificado->user_id = $authUser->id;
        }
        $inputPath = $request->file('certificado')->store('certificado/'.$authUser->id);
        $certificado->cert_path = $inputPath;
        if($certificado->save()){
            return redirect()->back()->with('message', 'El certificado ha sido guardado correctamente.');
        }else{
            return redirect()->back()->with('error', 'No se pudo guardar el certificado. Por favor intentar nuevamente.');
        }
    }

    public function storeKey(Request $request)
    {
        $authUser = Auth::user();
        $validation = Validator::make($request->all(), [
            'key' => 'required'
        ]);

        if($validation->fails()){
            return redirect()->back()->with('error', 'El certificado no es correcto. Por favor cargarlo nuevamente');
        }

        $certificado = FacturacionElectronicaCertificado::where('user_id', $authUser->id)->first();
        if(!$certificado){
            $certificado = new FacturacionElectronicaCertificado();
            $certificado->user_id = $authUser->id;
        }
        $inputPath = $request->file('key')->store('csr/'.$authUser->id);
        $certificado->key_path = $inputPath;
        if($certificado->save()){
            return redirect()->back()->with('message', 'El archivo CSR ha sido guardado correctamente.');
        }else{
            return redirect()->back()->with('error', 'No se pudo guardar el archivo CSR. Por favor intentar nuevamente.');
        }
    }

    public function generate(Request $request)
    {
        $authUser = Auth::user();
        $certificado = FacturacionElectronicaCertificado::where('user_id', $authUser->id)->first();
        if(!$certificado){
            $certificado = new FacturacionElectronicaCertificado();
            $certificado->user_id = $authUser->id;
		}
		$opensslPath = "C:/xampp/php/extras/ssl/openssl.cnf";
        $args = array(
			'config' => $opensslPath,
			'private_key_bits' => 2048,
			'private_key_type' => OPENSSL_KEYTYPE_RSA,
		);

		// Generate a new private (and public) key pair
		$privateKey = openssl_pkey_new($args);


		// Generate CSR
		$dn = array(
			'C' => 'AR',
			'O' => 'Gonzalo Gomez',
			'CN' => 'Dorita365',
			'serialNumber' => 'CUIT 20389531376',
		);

		$csr  = openssl_csr_new($dn, $privateKey, array('config' => $opensslPath));

		openssl_csr_export($csr, $csr_string);

		// Save private key and update database with the info
		openssl_pkey_export($privateKey, $privateKeyOut, '', array('config' => $opensslPath, 'private_key_type' => OPENSSL_KEYTYPE_RSA, 'encrypt_key' => false));
		// dd(storage_path());
		Storage::put('csr/'.$authUser->id.'/privKey.txt', $privateKeyOut);
        Storage::put('csr/'.$authUser->id.'/csrRequest.txt', $csr_string);

        // Save private key path
        $certificado->key_path = 'csr/'.$authUser->id.'/privKey.txt';
        $certificado->save();

        // CSR string should be returned to the user in a file to upload to AFIP
        return response()->download(storage_path('app/csr/'.$authUser->id.'/csrRequest.txt'));
		// dd($csr_string);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FacturacionElectronicaCertificado  $facturacionElectronicaCertificado
     * @return \Illuminate\Http\Response
     */
    public function show(FacturacionElectronicaCertificado $facturacionElectronicaCertificado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FacturacionElectronicaCertificado  $facturacionElectronicaCertificado
     * @return \Illuminate\Http\Response
     */
    public function edit(FacturacionElectronicaCertificado $facturacionElectronicaCertificado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FacturacionElectronicaCertificado  $facturacionElectronicaCertificado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $authUser = Auth::user();

        try {
            $facturacionElectronicaCertificado = FacturacionElectronicaCertificado::where('user_id', $authUser->id)->first();

            if(!$facturacionElectronicaCertificado){
                return redirect()->back()->with('error', 'No se pudo encontrar la información relacionada al certificado. Por favor intente nuevamente.');
            }

            $data = array(
                'tipo_comprobante' => $request->tipo_comprobante,
                'concepto' => $request->concepto,
                'tipo_documento' => $request->tipo_documento,
                'tipo_alicuota' => $request->tipo_alicuota,
                'moneda_id' => $request->moneda_id,
                'tipo_tributo' => $request->tipo_tributo,
                'tipo_opcion' => $request->tipo_opcion,
                'moneda_cotizacion' => 1,
            );
            $facturacionElectronicaCertificado->fill($data)->save();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ha ocurrido un error. Por favor intente nuevamente. '.$e);
        }
        return redirect()->back()->with('message', 'Datos actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FacturacionElectronicaCertificado  $facturacionElectronicaCertificado
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacturacionElectronicaCertificado $facturacionElectronicaCertificado)
    {
        //
    }
}
