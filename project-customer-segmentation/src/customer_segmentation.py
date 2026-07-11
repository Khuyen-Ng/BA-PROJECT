import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns
from sklearn.cluster import KMeans

sns.set(style="whitegrid")


def generate_customer_data():
    np.random.seed(24)
    n_customers = 200
    data = {
        "customer_id": range(1, n_customers + 1),
        "recency": np.random.randint(1, 100, size=n_customers),
        "frequency": np.random.randint(1, 20, size=n_customers),
        "monetary": np.random.randint(50, 2000, size=n_customers),
    }
    return pd.DataFrame(data)


def segment_customers(df, n_clusters=3):
    features = df[["recency", "frequency", "monetary"]]
    model = KMeans(n_clusters=n_clusters, random_state=42)
    df["segment"] = model.fit_predict(features)
    return df, model


def analyze_segments(df):
    summary = df.groupby("segment")["recency", "frequency", "monetary"].mean()
    print("--- Tổng quan các phân khúc ---")
    print(summary)
    return summary


def plot_segments(df):
    plt.figure(figsize=(10, 6))
    sns.scatterplot(
        data=df,
        x="recency",
        y="monetary",
        hue="segment",
        palette="Set2",
        s=80,
    )
    plt.title("Phân khúc khách hàng theo Recency và Monetary")
    plt.xlabel("Recency")
    plt.ylabel("Monetary")
    plt.tight_layout()
    plt.savefig("customer_segments.png")
    plt.close()
    print("Đã lưu biểu đồ vào customer_segments.png")


def main():
    df = generate_customer_data()
    df, model = segment_customers(df)
    analyze_segments(df)
    plot_segments(df)


if __name__ == "__main__":
    main()
