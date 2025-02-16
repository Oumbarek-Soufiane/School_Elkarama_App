import axios from "axios";
import { getAuthToken } from "../loaders";
import { AppURL } from "../../apis/AppURL";

export async function courseAction({ request, params }) {
  const formData = await request.formData();

  const couseData = new FormData();
  couseData.append("group_id", formData.get("group_id"));
  couseData.append("subject_id", formData.get("subject_id"));
  couseData.append("course_name", formData.get("course_name"));
  couseData.append("description", formData.get("description"));
  couseData.append("type", formData.get("type"));

  const courseFile = formData.get("file");
  if (courseFile && courseFile instanceof File) {
    couseData.append("file", courseFile);
  }

  const authToken = getAuthToken();
  const url = params.id ? AppURL.manageCourse(params.id) : AppURL.newCouse();
  const method = params.id ? "put" : "post";

  try {
    const headers = {
      Authorization: `Bearer ${authToken}`,
      "Content-Type": "multipart/form-data",
    };

    if (method === "put") {
      headers["X-HTTP-Method-Override"] = "PUT";
    }

    const response = await axios({
      method: "POST",
      url: url,
      data: couseData,
      headers: headers,
    });

    console.log(response.data);
    return response.data;
  } catch (error) {
    if (error.response && error.response.status === 422) {
      const errors = error.response.data.errors;
      console.log(errors);
      return { errors };
    }

    console.error("API Error:", error);
    return { error: "Une erreur est survenue lors de la requête API" };
  }
}
