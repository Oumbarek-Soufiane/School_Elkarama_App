import axios from "axios";
import { getAuthToken } from "../loaders";
import { AppURL } from "../../apis/AppURL";

export async function teacherAction({ request, params }) {
  const formData = await request.formData();

  const teacherData = new FormData();
  teacherData.append("teacher_cin", formData.get("teacher_cin"));
  teacherData.append("teacher_first_name", formData.get("teacher_first_name"));
  teacherData.append("teacher_last_name", formData.get("teacher_last_name"));
  teacherData.append(
    "teacher_date_of_birth",
    formData.get("teacher_date_of_birth")
  );
  teacherData.append(
    "teacher_place_of_birth",
    formData.get("teacher_place_of_birth")
  );
  teacherData.append("teacher_gender", formData.get("teacher_gender"));
  teacherData.append("teacher_address", formData.get("teacher_address"));
  teacherData.append("teacher_email", formData.get("teacher_email"));
  teacherData.append(
    "teacher_phone_number",
    formData.get("teacher_phone_number")
  );
  teacherData.append(
    "teacher_nationality",
    formData.get("teacher_nationality")
  );
  teacherData.append("teacher_diploma", formData.get("teacher_diploma"));

  const teacherImage = formData.get("teacher_image");
  if (teacherImage && teacherImage instanceof File) {
    teacherData.append("teacher_image", teacherImage);
  }

  const subjects = formData.getAll("subjects[]");
  subjects.forEach((subject, index) => {
    teacherData.append(`subjects[${index}]`, subject);
  });

  const authToken = getAuthToken();
  const url = params.id ? AppURL.manageTeacher(params.id) : AppURL.newTeacher();
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
      method: "post",
      url: url,
      data: teacherData,
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
