import axios from "axios";
import { getAuthToken } from "../loaders";
import { AppURL } from "../../apis/AppURL";

export async function evaluationAction({ request, params }) {
  const formData = await request.formData();

  const evaluationData = {
    group_id: formData.get("group_id"),
    subject_id: formData.get("subject_id"),
    teacher_id: formData.get("teacher_id"),
    evaluation_number: formData.get("evaluation_number"),
    type: formData.get("type"),
    date: formData.get("date"),
    start_time: formData.get("start_time"),
    end_time: formData.get("end_time"),
    description: formData.get("description"),
    status: formData.get("status"),
    semester: formData.get("semester"),
  };

  console.log("Sending evaluation data:", evaluationData);

  const authToken = getAuthToken();
  const url = params.id
    ? AppURL.manageEvaluation(params.id)
    : AppURL.newEvaluation();
  const method = params.id ? "put" : "post";

  try {
    const response = await axios({
      method: method,
      url: url,
      data: evaluationData,
      headers: {
        Authorization: `Bearer ${authToken}`,
        "Content-Type": "application/json",
      },
    });

    return response.data;
  } catch (error) {
    if (error.response && error.response.status === 422) {
      const errors = error.response.data.errors;
      console.error("Validation errors:", errors);
      return { error: "Erreur de validation", details: errors };
    }

    console.error("API Error:", error);
    return { error: "Une erreur est survenue lors de la requête API" };
  }
}
