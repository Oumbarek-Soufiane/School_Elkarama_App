<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class LevelController extends Controller
{
    public function index()
    {
        try {
            $levels = Level::with('sections.groups')->get();
            if ($levels->isEmpty()) {
                return response()->json([
                    'message' => 'Aucun niveau scolaire trouvé',
                    'levels' => []
                ], 200);
            }
            return response()->json([
                'message' => 'Liste de tous les niveaux scolaires récupérée avec succès',
                'levels' => $levels
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des niveaux scolaires : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $level = Level::find($id);
            if (!$level) {
                return response()->json([
                    'message' => 'Niveau scolaire non trouvé'
                ], 404);
            }
            return response()->json([
                'message' => 'Niveau scolaire récupéré avec succès',
                'level' => $level
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération du niveau scolaire : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        Log::info($request->all());  
    
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:levels,name',
                'description' => 'nullable|string',
                'responsible_name' => 'nullable|string',
                'level_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'responsible_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], [
                'name.required' => 'Le champ nom est requis.',
                'name.string' => 'Le champ nom doit être une chaîne de caractères.',
                'name.max' => 'Le champ nom ne doit pas dépasser 255 caractères.',
                'name.unique' => 'Le champ nom doit être unique.',
                'description.string' => 'Le champ description doit être une chaîne de caractères.',
                'responsible_name.string' => 'Le champ nom du responsable doit être une chaîne de caractères.',
                'level_image.image' => 'Le champ image de niveau doit être une image.',
                'level_image.mimes' => 'Le champ image de niveau doit être un fichier de type: jpeg, png, jpg, gif, svg.',
                'level_image.max' => 'Le champ image de niveau ne doit pas dépasser 2 MB.',
                'responsible_image.image' => 'Le champ image du responsable doit être une image.',
                'responsible_image.mimes' => 'Le champ image du responsable doit être un fichier de type: jpeg, png, jpg, gif, svg.',
                'responsible_image.max' => 'Le champ image du responsable ne doit pas dépasser 2 MB.',
            ]);
    
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'responsible_name' => $request->responsible_name,
            ];
    
            if ($request->hasFile('level_image')) {
                $levelImage = $request->file('level_image')->store('levels', 'public');
                $data['level_image'] = Storage::url($levelImage);
            }
    
            if ($request->hasFile('responsible_image')) {
                $responsibleImage = $request->file('responsible_image')->store('levels', 'public');
                $data['responsible_image'] = Storage::url($responsibleImage);
            }
    
            $level = Level::create($data);
    
            return response()->json([
                'message' => 'Niveau scolaire créé avec succès',
                'level' => $level
            ], 201);
        } catch (ValidationException $e) {
            Log::error('Validation Error:', ['errors' => $e->errors()]);  
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            Log::error('Creation Error:', ['message' => $exception->getMessage()]);  
            return response()->json([
                'message' => 'Erreur lors de la création du niveau scolaire : ' . $exception->getMessage()
            ], 500);
        }
    }
    


    public function update(Request $request, $id)
    {        Log::info($request->all());  

        try {
            $level = Level::findOrFail($id);
            $request->validate([
                'name' => 'required|string|max:255|unique:levels,name,' . $id,
                'description' => 'nullable|string',
                'responsible_name' => 'nullable|string',
                'level_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'responsible_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],[
                'name.required' => 'Le champ nom est requis.',
                'name.string' => 'Le champ nom doit être une chaîne de caractères.',
                'name.max' => 'Le champ nom ne doit pas dépasser 255 caractères.',
                'name.unique' => 'Le champ nom doit être unique.',
                'description.string' => 'Le champ description doit être une chaîne de caractères.',
                'responsible_name.string' => 'Le champ nom du responsable doit être une chaîne de caractères.',
                'level_image.image' => 'Le champ image de niveau doit être une image.',
                'level_image.mimes' => 'Le champ image de niveau doit être un fichier de type: jpeg, png, jpg, gif, svg.',
                'level_image.max' => 'Le champ image de niveau ne doit pas dépasser 2 MB.',
                'responsible_image.image' => 'Le champ image du responsable doit être une image.',
                'responsible_image.mimes' => 'Le champ image du responsable doit être un fichier de type: jpeg, png, jpg, gif, svg.',
                'responsible_image.max' => 'Le champ image du responsable ne doit pas dépasser 2 MB.',
            ]);
    
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'responsible_name' => $request->responsible_name,
            ];
    
            if ($request->hasFile('level_image')) {
                $levelImage = $request->file('level_image')->store('levels', 'public');
                $data['level_image'] = Storage::url($levelImage);
            }
    
            if ($request->hasFile('responsible_image')) {
                $responsibleImage = $request->file('responsible_image')->store('levels', 'public');
                $data['responsible_image'] = Storage::url($responsibleImage);
            }
    
            $level->update($data);
    
            return response()->json([
                'message' => 'Niveau scolaire mis à jour avec succès',
                'level' => $level
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Niveau scolaire non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la mise à jour du niveau scolaire : ' . $exception->getMessage()
            ], 500);
        }
    }
    

    public function destroy($id)
    {
        try {
            $level = Level::find($id);
            if (!$level) {
                return response()->json([
                    'message' => 'Niveau scolaire non trouvé'
                ], 404);
            }

            if ($level->level_image) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $level->level_image));
            }
            if ($level->responsible_image) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $level->responsible_image));
            }

            $level->delete();
            return response()->json([
                'message' => 'Niveau scolaire supprimé avec succès'
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la suppression du niveau scolaire : ' . $exception->getMessage()
            ], 500);
        }
    }
}