import axios from "axios";
import { getAuthToken } from "../loaders";
import { AppURL } from "../../apis/AppURL";

export async function assignStudentsAbsencesAction({ request }) {
  const formData = await request.formData();

  const assignStudentAbsence = {
    group_id: formData.get("group_id"),
    subject_id: formData.get("subject_id"),
    date: formData.get("date"),
    start_time: formData.get("start_time"),
    end_time: formData.get("end_time"),
    students: Array.from(formData.getAll("absent_students[]")),
  };

  console.log(formData.getAll("absent_students[]"));

  const authToken = getAuthToken();
  const url = AppURL.assignAbsencesToStudents();

  try {
    const response = await axios.post(url, assignStudentAbsence, {
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
