# Đây là ví dụ đơn giản huấn luyện real-time với dữ liệu từ request
# uvicorn api_word2vec:app --host 0.0.0.0 --port 8002 --reload --log-level debug
from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from gensim.models import Word2Vec
from nltk.tokenize import word_tokenize
from sklearn.metrics.pairwise import cosine_similarity
import numpy as np
import nltk
import logging

nltk.download('punkt')

logging.basicConfig(
    level=logging.DEBUG,
    format="%(asctime)s [%(levelname)s] %(message)s",
    handlers=[logging.StreamHandler()]
)
logger = logging.getLogger(__name__)

app = FastAPI()

class RetrainRequest(BaseModel):
    preference: str
    course_descriptions: list[str]

@app.post("/retrain_and_recommend")
def retrain_and_recommend(req: RetrainRequest):
    try:
        # Tokenize từng câu cho việc huấn luyện
        tokenized_sentences = [word_tokenize(s.lower()) for s in req.course_descriptions]
        # Thêm sở thích vào tập dữ liệu
        tokenized_sentences.append(word_tokenize(req.preference.lower()))

        # Huấn luyện mô hình Word2Vec real-time với cấu hình nhỏ (skip-gram)
        model = Word2Vec(sentences=tokenized_sentences, vector_size=100, window=5, min_count=1, sg=1)
        # Tính vector trung bình cho sở thích
        def get_sentence_vector(sentence, model):
            tokens = word_tokenize(sentence.lower())
            vectors = [model.wv[word] for word in tokens if word in model.wv]
            return np.mean(vectors, axis=0) if vectors else np.zeros(model.vector_size)

        pref_vec = get_sentence_vector(req.preference, model)
        course_vecs = [get_sentence_vector(desc, model) for desc in req.course_descriptions]

        similarities = cosine_similarity([pref_vec], course_vecs)[0]
        similarities = np.array(similarities)

        top3_idx = similarities.argsort()[-3:][::-1]
        top3 = [{"index": int(idx), "score": float(similarities[idx])} for idx in top3_idx]
        logger.debug("Top3 (retrain): %s", top3)
        return {"top3": top3}
    except Exception as e:
        logger.error("Error in /retrain_and_recommend: %s", str(e))
        raise HTTPException(status_code=500, detail=str(e))
