<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    //

    public function listeEtudiant()
    {

        $etudiants = Etudiant::all();
        return  view('etudiant.liste', compact('etudiants'));
    }

    public function ajouterEtudiant()
    {
        return  view('etudiant.ajouter');
    }

    public function ajouterEtudiantTraitement(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'classe' => 'required',
        ]);

        $etudiant = new Etudiant();
        $etudiant->nom = $request->nom;
        $etudiant->prenom = $request->prenom;
        $etudiant->classe = $request->classe;
        $etudiant->save();
        return redirect('/ajouter')->with('status', 'done');
    }


    public function updateEtudiant($id)
    {

        $etudiants = Etudiant::find($id);

        return view('etudiant.update', compact('etudiants'));
    }

    public function updateEtudiantTraitement(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'classe' => 'required',
        ]);

        $etudiant =  Etudiant::find($request->id);
        $etudiant->nom = $request->nom;
        $etudiant->prenom = $request->prenom;
        $etudiant->classe = $request->classe;
        $etudiant->update();
        return redirect('/etudiant')->with('status', 'done');
    }


    public function deleteEtudiant($id)
    {

        $etudiant = Etudiant::find($id);
        $etudiant->delete();
        return redirect('/etudiant')->with('status', 'etudiant supprimé');
    }
}