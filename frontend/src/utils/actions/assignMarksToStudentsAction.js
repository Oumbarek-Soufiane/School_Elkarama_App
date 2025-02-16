import axios from "axios";
import { getAuthToken } from "../loaders";
import { AppURL } from "../../apis/AppURL";

export async function assignMarksToStudentsAction({ request }) {
  const formData = await request.formData();

  const evaluationId = formData.get("evaluation_id");
  let studentsData = formData.get("students");

  if (!studentsData) {
    return { error: "Aucune donnée d'étudiant trouvée dans le formulaire." };
  }

  try {
    studentsData = JSON.parse(studentsData);

    if (!Array.isArray(studentsData)) {
      throw new Error(
        "Les données des étudiants ne sont pas sous forme de tableau."
      );
    }
  } catch (error) {
    return {
      error: "Erreur lors de l'analyse des données des étudiants.",
      details: error.message,
    };
  }

  const marksData = {
    evaluation_id: evaluationId,
    students: studentsData.map((student) => ({
      id: student.id,
      score: student.mark,
      comment: student.comment,
    })),
  };

  const authToken = getAuthToken();
  const url = AppURL.assignMarksToStudents();

  try {
    const response = await axios.post(url, marksData, {
      headers: {
        Authorization: `Bearer ${authToken}`,
        "Content-Type": "application/json",
      },
    });

    return response.data;
  } catch (error) {
    if (error.response && error.response.status === 422) {
      const errors = error.response.data.errors;
      let errorMessage =
        errors && errors.name ? errors.name[0] : "Erreur de validation";
      return { error: errorMessage };
    }

    console.error("API Error:", error);
    return { error: "Une erreur est survenue lors de la requête API" };
  }
}
