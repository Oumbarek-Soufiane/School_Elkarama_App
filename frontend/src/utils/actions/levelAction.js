import axios from "axios";
import { getAuthToken } from "../loaders";
import { AppURL } from "../../apis/AppURL";

export async function levelAction({ request, params }) {
  const formData = await request.formData();

  const levelData = new FormData();
  levelData.append("name", formData.get("name"));
  levelData.append("description", formData.get("description"));
  levelData.append("responsible_name", formData.get("responsible_name"));

  const levelImage = formData.get("level_image");
  if (levelImage && levelImage instanceof File) {
    levelData.append("level_image", levelImage);
  }

  const responsibleImage = formData.get("responsible_image");
  if (responsibleImage && responsibleImage instanceof File) {
    levelData.append("responsible_image", responsibleImage);
  }

  const authToken = getAuthToken();
  const url = params.id ? AppURL.manageLevel(params.id) : AppURL.newLevel();
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
      data: levelData,
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
