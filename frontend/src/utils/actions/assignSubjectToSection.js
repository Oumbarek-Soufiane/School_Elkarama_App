import axios from "axios";
import { getAuthToken, subjectsLoader } from "../loaders";
import { AppURL } from "../../apis/AppURL";

export async function assignSubjectToSection({ request }) {
  const formData = await request.formData();
  const subjects = await subjectsLoader();
  const assignSubjectToSectionData = {
    section_id: formData.get("section_id"),
    subjects: subjects.subjects
      .map((subject) => ({
        id: subject.id,
        coefficient: formData.get(`coefficient_${subject.id}`),
        hours: formData.get(`hours_${subject.id}`),
        assign: formData.get(`assign_subject_${subject.id}`) ? true : false,
      }))
      .filter((subject) => subject.assign),
  };

  const authToken = getAuthToken();
  const url = AppURL.assignSubjectToSection();

  try {
    const response = await axios({
      method: "post",
      url: url,
      data: assignSubjectToSectionData,
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
