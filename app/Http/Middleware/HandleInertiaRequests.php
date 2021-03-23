<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Models\Petugas;
use App\Models\Siswa;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [   
            'auth' => [
                'user' => fn () => 
                    $request->user() && $request->user()->id_petugas ? Petugas::findOrFail($request->user()->id_petugas) : 
                    ( $request->user() && $request->user()->nisn_siswa ? Siswa::where('nisn', $request->user()->nisn_siswa)->with('kelas')->firstOrFail(): null),
            ],

            'toast' => fn () => $request->session()->get('toast')
        ]);
    }
}
