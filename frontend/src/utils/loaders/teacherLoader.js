import axios from "axios";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "../loaders";

export async function teacherLoader({ params }) {
  const authToken = getAuthToken();

  try {
    const [teacherResponse, subjectsResponse] = await Promise.all([
      axios.get(AppURL.manageTeacher(params.id), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      }),
      axios.get(AppURL.allSubjects(), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      }),
    ]);

    const teacherData = teacherResponse.data;
    const subjectsData = subjectsResponse.data;

    return { teacher: teacherData.teacher, subjects: subjectsData.subjects };
  } catch (error) {
    console.error("Error fetching teacher or subjects data:", error);
    throw error;
  }
}
export async function teachersLoader() {
  const authToken = getAuthToken();

  try {
    const response = await axios.get(AppURL.allTeachers(), {
      headers: {
        Authorization: `Bearer ${authToken}`,
      },
    });
    return response.data;
  } catch (error) {
    console.error("Error fetching teachers data:", error);
    throw error;
  }
}
